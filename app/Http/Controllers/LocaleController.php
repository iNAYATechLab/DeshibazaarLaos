<?php
namespace App\Http\Controllers;use Illuminate\Http\Request;
class LocaleController extends Controller { public function __invoke(Request $r,string $locale){abort_unless(in_array($locale,['en','bn','hi']),404);session(['locale'=>$locale]);return back();} }
