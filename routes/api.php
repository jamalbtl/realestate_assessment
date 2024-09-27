<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\PropertyController;
use Illuminate\Validation\ValidationException;

// Login Route to issue Personal Access Token
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::get('property-list',[PropertyController::class,'getPropertyList']);
Route::post('create-property',[PropertyController::class,'createProperty']);
Route::get('property-details/{propertyId}',[PropertyController::class,'getPropertyDetail']);
Route::put('modify-property/{propertyId}',[PropertyController::class,'updateProperty']);
Route::delete('delete-property/{propertyId}',[PropertyController::class,'deleteProperty']);
// Protected Route for Authenticated Users
Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


?>