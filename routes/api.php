use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::prefix('v1')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/user/{id}/update-exp', [UserController::class, 'updateExp']);
});