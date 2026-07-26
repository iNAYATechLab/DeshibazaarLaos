#!/usr/bin/env bash
# Create a production deployment archive. Run after Composer and frontend builds.
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
VERSION_FILE="$ROOT_DIR/VERSION"
VERSION="${1:-$(tr -d '[:space:]' < "$VERSION_FILE")}" 

if [[ ! "$VERSION" =~ ^v[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
  echo "Error: version must be valid SemVer with a v prefix (for example v0.2.0)." >&2
  exit 1
fi

export ROOT_DIR VERSION
python3 <<'PY'
import os
import shutil
import zipfile
from pathlib import Path

root = Path(os.environ['ROOT_DIR'])
version = os.environ['VERSION']
release_dir = root / 'releases'
archive = release_dir / f'deshibazaar-{version}.zip'
staging = root / '.release-staging'

# Only production application material is copied.  vendor is added when CI has
# installed Composer's --no-dev dependencies; public/build is added after Vite.
ignored_names = {
    '.git', '.github', 'node_modules', 'vendor', 'tests', 'releases',
    '.release-staging', 'coverage', '.idea', '.vscode', '__pycache__',
}
ignored_prefixes = {
    Path('storage/logs'), Path('storage/framework/cache'),
    Path('storage/framework/sessions'), Path('storage/framework/testing'),
    Path('storage/framework/views'),
}
ignored_files = {'.env', '.DS_Store'}

if staging.exists():
    shutil.rmtree(staging)
staging.mkdir(parents=True)
release_dir.mkdir(exist_ok=True)
if archive.exists():
    archive.unlink()

for source in root.rglob('*'):
    relative = source.relative_to(root)
    if any(part in ignored_names for part in relative.parts):
        continue
    if any(relative == prefix or prefix in relative.parents for prefix in ignored_prefixes):
        continue
    if source.name in ignored_files or source.name.startswith('.env.') or source.suffix == '.zip':
        continue
    destination = staging / relative
    if source.is_dir():
        destination.mkdir(parents=True, exist_ok=True)
    elif source.is_file():
        destination.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(source, destination)

for runtime_dir in (
    'storage/logs', 'storage/framework/cache', 'storage/framework/sessions',
    'storage/framework/views', 'bootstrap/cache',
):
    (staging / runtime_dir).mkdir(parents=True, exist_ok=True)

for generated_dir in ('vendor', 'public/build'):
    source = root / generated_dir
    if source.is_dir():
        shutil.copytree(source, staging / generated_dir, dirs_exist_ok=True)

with zipfile.ZipFile(archive, 'w', zipfile.ZIP_DEFLATED, compresslevel=9) as bundle:
    for source in staging.rglob('*'):
        if source.is_file():
            bundle.write(source, source.relative_to(staging))

shutil.rmtree(staging)
print(archive)
PY
