<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Suppliers;
use Illuminate\Http\Request;

class Supplier extends Controller
{
   // Show all suppliers
   public function index()
   {
       $suppliers = Suppliers::all();  // Retrieve all suppliers
       return response()->json([
           'success' => true,
           'data' => $suppliers,
       ]);
   }

   // Store a new supplier
   public function store(Request $request)
   {
       // Validate the input
       $request->validate([
           'name' => 'required|string|max:255',
           'contact_name' => 'required|string|max:255',
           'contact_email' => 'required|email|max:255',
           'contact_phone' => 'nullable|string|max:15',
           'address' => 'nullable|string|max:255',
           'website' => 'nullable|url',
           'socials' => 'nullable|array',
       ]);

       // Create a new supplier in the database
       $supplier = Suppliers::create($request->all());

       // Return success response
       return response()->json([
           'success' => true,
           'message' => 'Supplier created successfully!',
           'data' => $supplier,
       ], 201);
   }

   // Show a specific supplier
   public function show($id)
   {
       $supplier = Suppliers::findOrFail($id);  // Retrieve the supplier by id
       return response()->json([
           'success' => true,
           'data' => $supplier,
       ]);
   }

   // Update an existing supplier
   public function update(Request $request, $id)
   {
       // Validate the input
       $request->validate([
           'name' => 'required|string|max:255',
           'contact_name' => 'required|string|max:255',
           'contact_email' => 'required|email|max:255',
           'contact_phone' => 'nullable|string|max:15',
           'address' => 'nullable|string|max:255',
           'website' => 'nullable|url',
           'socials' => 'nullable|array',
       ]);

       // Find the supplier and update the record
       $supplier = Suppliers::findOrFail($id);
       $supplier->update($request->all());

       // Return success response
       return response()->json([
           'success' => true,
           'message' => 'Supplier updated successfully!',
           'data' => $supplier,
       ]);
   }

   // Delete a supplier
   public function destroy($id)
   {
       // Find the supplier and delete
       $supplier = Suppliers::findOrFail($id);
       $supplier->delete();

       // Return success response
       return response()->json([
           'success' => true,
           'message' => 'Supplier deleted successfully!',
       ]);
   }
}
