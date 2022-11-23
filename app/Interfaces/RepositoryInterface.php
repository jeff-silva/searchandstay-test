<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RepositoryInterface
{
  public function index(Request $request);
  public function store(Request $request);
  public function show($id);
  public function update(Request $request, $id);
  public function destroy($id);
}
