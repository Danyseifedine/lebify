<?php

namespace App\Console\Commands\BaseController;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BaseControllerCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:base-controller';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a BaseController with common functions.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseControllerPath = app_path('Http/Controllers/BaseController.php');

        // Check if BaseController already exists
        if (File::exists($baseControllerPath)) {
            $this->error('BaseController already exists.');
            return;
        }

        // MAIN CODE HERE
        $baseControllerContent = <<<EOT

        EOT;

        function colorize($text, $colorCode)
        {
            return "\e[{$colorCode}m{$text}\e[0m";
        }

        function updateProgress($progress, $name)
        {
            $spinner = [colorize('-', '32'), colorize('\\', '32'), colorize('|', '32'), colorize('/', '32')];
            $spinnerIndex = $progress % 4;
            $bar = str_repeat('=', $progress / 5);
            $spaces = str_repeat(' ', 20 - ($progress / 5));

            $coloredName = colorize($name, '34');

            echo "\r$coloredName: [" . colorize($bar, '31') . colorize($spaces, '37') . "] " . $spinner[$spinnerIndex];
            usleep(50000); // Adjust the sleep time to control the speed
        }


        $openClass = <<<EOT
        class BaseController extends Controller
        {\n
        EOT;


        $closeClass = <<<EOT
        \n}
        EOT;

        $use = <<<EOT
        <?php

        namespace App\Http\Controllers;

        use App\Models\User;
        use DateTime;
        use Exception;
        use Illuminate\Database\Eloquent\Model;
        use Illuminate\Database\Eloquent\ModelNotFoundException;
        use Illuminate\Http\RedirectResponse;
        use Illuminate\Http\Request;
        use Illuminate\Http\UploadedFile;
        use Illuminate\Support\Facades\Artisan;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\File;
        use Illuminate\Support\Facades\Hash;
        use Illuminate\Support\Facades\Http;
        use \Illuminate\Support\Facades\Log;
        use Illuminate\Validation\ValidationException;
        use Illuminate\View\View;
        use InvalidArgumentException;
        use NumberFormatter;
        \n
        EOT;



        $redirectWithMessage = <<<EOT
            /**
             * Redirect to a named route with a flashed message.
             *
             * @param string \$view         The name of the route to redirect to.
             * @param string \$messageKey   The key for the flashed message.
             * @param string \$messageValue The value of the flashed message.
             *
             * @return \Illuminate\Http\RedirectResponse
             *
             * @throws \InvalidArgumentException If the provided view is invalid or not found.
             *
             * ```php
             *  Example usage:
             *  \$this->redirectWithMessage('route.name', 'success', 'Operation successful!');
             *```
             *
             * @description
             *     This function redirects to a named route with a flashed message. It uses Laravel's `redirect` method
             *     to generate the redirect response and the `with` method to flash the provided message to the session.
             *     The named route, message key, and message value are provided as parameters.
             */
            function redirectWithMessage(string \$view, string \$messageKey, string \$messageValue): RedirectResponse
            {
                return redirect()->route(\$view)->with(\$messageKey, \$messageValue);
            }\n \n \n
        EOT;

        $redirectBack = <<<EOT
            /**
             * Redirect back to the previous page.
             *
             * @return \Illuminate\Http\RedirectResponse
             *
             * @description
             *     This function redirects back to the previous page using Laravel's `redirect` method
             *     with the `back` method. It is useful for returning to the page that initiated the current request.
             *
             * @example
             *     // Example usage:
             *     \$this->redirectBack();
             */
            function redirectBack(): RedirectResponse
            {
                return redirect()->back();
            }\n \n \n
        EOT;

        $backWithMessage = <<<EOT
            /**
             * Redirect back to the previous page with a flashed message.
             *
             * @param string \$messageKey   The key for the flashed message.
             * @param string \$messageValue The value of the flashed message.
             *
             * @return \Illuminate\Http\RedirectResponse
             *
             *
             * ```php
             *     Example usage:
             *     \$this->backWithMessage('info', 'Please try again later.');
             * ```
             *
             *  @description
             *     This function redirects back to the previous page using Laravel's `redirect` method
             *     with the `back` method. It includes a flashed message using the `with` method,
             *     with the provided message key and value.
             */
            function backWithMessage(string \$messageKey, string \$messageValue): RedirectResponse
            {
                return redirect()->back()->with(\$messageKey, \$messageValue);
            }\n \n \n
        EOT;

        $simpleRedirect = <<<EOT
            /**
             * Simple redirect to a named route or URL.
             *
             * @param string \$view The name of the route or URL to redirect to.
             *
             * @return \Illuminate\Http\RedirectResponse
             *
             *
             * ```php
             *     Example usage:
             *     \$this->simpleRedirect('route.name');
             *     or
             *     \$this->simpleRedirect('https://example.com');
             * ```
             *
             *  @description
             *     This function performs a simple redirect to the specified named route or URL
             *     using Laravel's `redirect` method. The provided string in the \$view parameter
             *     represents either the name of a route or a full URL.
             */
            function simpleRedirect(string \$view): RedirectResponse
            {
                return redirect(\$view);
            }\n \n \n
        EOT;

        $getFromRequest = <<<EOT
            /**
             * Get a string input from the given request by its input name.
             *
             * This function retrieves a string input from the provided request using the specified input name.
             * It ensures that the input is a string and throws an exception if it's not.
             *
             * @param \Illuminate\Http\Request \$request    The request instance.
             * @param string                   \$inputName The name of the input to retrieve from the request.
             *
             * @return string The retrieved string input.
             *
             * @throws \InvalidArgumentException If the input is not a string or if the input name is not found in the request.
             *
             * ```php
             *    \$this->getFromRequest(\$request, "name")
             * ```
             *
             * @description
             *     This function is designed to fetch a string input from a request by specifying the input name.
             *     It checks if the input is a string and throws an exception if it's not.
             *     If the input name is not found in the request, an exception is also thrown.
             *
             */
            function getFromRequest(Request \$req, string \$inputName): string
            {
                \$input = \$req->input(\$inputName);

                if (!is_string(\$input)) {
                    throw new InvalidArgumentException("Invalid input '\$inputName' - must be a string");
                }

                return \$input;
            }\n \n \n
        EOT;

        $GetFileFromRequest = <<<EOT
            /**
             * Get a file from the given request by its input name.
             *
             * This function retrieves a file from the provided request using the specified input name.
             * It returns the file as an UploadedFile instance.
             *
             * @param \Illuminate\Http\Request \$request    The request instance.
             * @param string                   \$inputName The name of the file input to retrieve from the request.
             *
             * @return \Illuminate\Http\UploadedFile The retrieved file as an UploadedFile instance.
             *
             * ```php
             * \$this->getFileFromRequest(\$request, "file")
             * ```
             *
             * @description
             *     This function is designed to fetch a file input from a request by specifying the input name.
             *     It returns the file as an UploadedFile instance. If the input name is not found in the request,
             *     or if it's not a file input, it will return null.
             */
            function GetFileFromRequest(Request \$request, string \$fieldName): ?UploadedFile
            {
                try {
                    if (\$request->hasFile(\$fieldName) && \$request->file(\$fieldName)->isValid()) {
                        return \$request->file(\$fieldName);
                    }
                    throw new InvalidArgumentException("Invalid or missing file in the request.");
                } catch (\Exception \$e) {
                    report(\$e);
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $createRecord = <<<EOT
            /**
             * Creates a new record in the database using the specified Eloquent model and data.
             *
             * @param class-string<\Illuminate\Database\Eloquent\Model> \$model The class name of the Eloquent model.
             * @param array<string,mixed>|null \$data The data to be inserted into the database.
             *
             * @return \Illuminate\Database\Eloquent\Model The created Eloquent model instance.
             *
             * @throws \InvalidArgumentException If the provided model is not a valid Eloquent model class.
             *
             * ```php
             *     \$userData = [
             *         'name' => 'John Doe',
             *         'password' => 'password',
             *     ];
             *     \$createdModel = \$this->createRecord(User::class, \$userData);
             *```
             * @description
             *     Use this function to insert a new record into the database using the specified Eloquent model.
             *     The model must be a valid Eloquent model class, and the data array represents the attributes
             *     of the new record. The function returns the created Eloquent model instance.
             *     If the provided model is not a valid Eloquent model class, an exception is thrown.
             */
            function createRecord(string \$model, ?array \$data = null): Model
            {
                if (!class_exists(\$model) || !is_subclass_of(\$model, Model::class)) {
                    throw new \InvalidArgumentException("\$model must be a valid Eloquent model.");
                }

                // Example usage:
                /** @var \Illuminate\Database\Eloquent\Model \$createdModel */
                \$createdModel = \$model::create(\$data);
                // You can now use \$createdModel as the created Eloquent model instance.

                return \$createdModel;
            }\n \n \n
        EOT;

        $updateRecord = <<<EOT
            /**
             * Update records based on the specified constraints with the provided data.
             *
             * @param string \$model The class name of the Eloquent model.
             * @param array \$constraints An associative array of constraints for the query.
             * @param array|null \$dataToUpdate The data to update records.
             *
             * @return mixed The result of the update operation.
             *
             * @throws \InvalidArgumentException If the provided model is not a valid Eloquent model class.
             *
             * ```php
             * // Example 1:
             * \$updateConstraints = ['id' => 1];
             * \$updatedData = ['title' => 'Updated Title', 'content' => 'New content'];
             * \$result = \$this->updateRecord(Post::class, \$updateConstraints, \$updatedData);
             * ```
             *
             * ```php
             * // Example 2:
             * \$updateConstraints = ['id' => 1, 'status' => 'active'];
             * \$updatedData = ['title' => 'Updated Title', 'content' => 'New content'];
             * \$result = \$this->updateRecord(Post::class, \$updateConstraints, \$updatedData);
             * ```
             *
             * @description
             *     Use this function to update records in the database using the specified Eloquent model.
             *     The model must be a valid Eloquent model class, and you can set constraints to specify
             *     which records to update. The data array represents the attributes to be updated.
             *     The function returns the result of the update operation.
             *     If the provided model is not a valid Eloquent model class, an exception is thrown.
             */
            function updateRecord(string \$model, array \$constraints = [], ?array \$dataToUpdate = null): mixed
            {
                if (!class_exists(\$model) || !is_subclass_of(\$model, \Illuminate\Database\Eloquent\Model::class)) {
                    throw new \InvalidArgumentException("\$model must be a valid Eloquent model.");
                }

                return \$model::where(\$constraints)->update(\$dataToUpdate);
            }\n \n \n
        EOT;

        $deleteRecord = <<<EOT
            /**
             * Delete records based on the specified constraints.
             *
             * @param class-string<\Illuminate\Database\Eloquent\Model> \$modelClass The class name of the Eloquent model.
             * @param array \$constraints An associative array of constraints for the query.
             *
             * @return mixed The result of the delete operation.
             *
             * @throws \InvalidArgumentException If the provided model class is not a valid Eloquent model.
             *
             * ```php
             *     // Example:
             *     \$deleteConstraints = ['id' => 1];
             *     \$result = \$this->deleteRecord(Post::class, \$deleteConstraints);
             * ```
             *
             * @description
             *     Use this function to delete records from the database using the specified Eloquent model.
             *     The model must be a valid Eloquent model class, and you can set constraints to specify
             *     which records to delete. The function returns the result of the delete operation.
             *     If the provided model class is not a valid Eloquent model, an exception is thrown.
             */
            function deleteRecord(string \$modelClass, array \$constraints = []): mixed
            {
                if (!class_exists(\$modelClass) || !is_subclass_of(\$modelClass, \Illuminate\Database\Eloquent\Model::class)) {
                    throw new \InvalidArgumentException("\$modelClass must be a valid Eloquent model.");
                }

                return \$modelClass::where(\$constraints)->delete();
            }\n \n \n
        EOT;

        $viewWithData = <<<EOT
            /**
             * Render a view with the provided data.
             *
             * @param string \$view The name of the view to render.
             * @param array \$data  The data to pass to the view.
             *
             * @return \Illuminate\Contracts\View\View
             *
             * ```php
             *     Example usage:
             *     \$this->viewWithData('example.view',
             *                        ['key' => 'value',
             *                         'foo' => 'bar']
             * );
             * ```
             *
             *  @description
             *     This function renders a view using Laravel's `view` method with the specified name.
             *     You can also pass an associative array of data to be made available to the view.
             *
             */
            function viewWithData(string \$view, array \$data = []): View
            {
                return view(\$view, \$data);
            }\n \n \n
        EOT;

        $registerUser = <<<EOT
            /**
             * Register a new user with the provided data.
             *
             * This function registers a new user with the provided data. It expects an array of user data
             * such as name, email, password, etc. It then creates a new user record in the specified Eloquent
             * model (usually the User model).
             *
             * @param string \$model The fully qualified class name of the Eloquent User model.
             * @param array \$userData The array of user data to be used for registration.
             *
             * @return \Illuminate\Database\Eloquent\Model The newly registered user model.
             *
             * @throws \Exception If an error occurs during the registration process.
             *
             * ```php
             * \$userData = [
             *     'name' => 'John Doe',
             *     'email' => 'john@example.com',
             *     'password' => bcrypt('secret'),
             * ];
             * \$registeredUser = registerUser(\App\Models\User::class, \$userData);
             * ```
             *
             * @description
             * This function facilitates the registration of a new user with the provided data. It's commonly
             * used during user registration processes. The function returns the newly created user model.
             *
             * It may throw an exception if there's an error during the registration process.
             */
            function registerUser(string \$model, array \$userData)
            {
                try {
                    // Create a new user record
                    return \$model::create(\$userData);
                } catch (\Exception \$e) {
                    // Log and rethrow the exception
                    Log::error(\$e->getMessage());
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $registerAndAuthenticateUser = <<<EOT
            /**
             * Register a new user with the provided data and authenticate them.
             *
             * This function registers a new user with the provided data. It expects an array of user data
             * such as name, email, password, etc. It then creates a new user record in the specified Eloquent
             * model (usually the User model) and authenticates the user.
             *
             * @param string \$model The fully qualified class name of the Eloquent User model.
             * @param array \$userData The array of user data to be used for registration.
             *
             * @return \Illuminate\Database\Eloquent\Model The newly registered and authenticated user model.
             *
             * @throws \Exception If an error occurs during the registration or authentication process.
             *
             * ```php
             * \$userData = [
             *     'name' => 'John Doe',
             *     'email' => 'john@example.com',
             *     'password' => bcrypt('secret'),
             * ];
             * \$authenticatedUser = registerAndAuthenticateUser(\App\Models\User::class, \$userData);
             * ```
             *
             * @description
             * This function facilitates the registration of a new user with the provided data and authenticates them.
             * It's commonly used during user registration processes. The function returns the newly created and authenticated
             * user model.
             *
             * It may throw an exception if there's an error during the registration or authentication process.
             */
            function registerAndAuthenticateUser(string \$model, array \$userData)
            {
                try {
                    // Create a new user record
                    \$user = \$model::create(\$userData);

                    // Authenticate the user
                    Auth::login(\$user);

                    return \$user;
                } catch (\Exception \$e) {
                    // Log and rethrow the exception
                    Log::error(\$e->getMessage());
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $loginUser = <<<EOT
            /**
             * Authenticate a user with the provided credentials.
             *
             * This function attempts to authenticate a user with the provided email and password
             * using Laravel's built-in authentication system. If the authentication is successful,
             * the authenticated user model is returned. If not, it throws an exception.
             *
             * @param string \$email The email of the user to be authenticated.
             * @param string \$password The password of the user to be authenticated.
             *
             * @return \Illuminate\Database\Eloquent\Model The authenticated user model.
             *
             * @throws \Exception If authentication fails or an error occurs during the process.
             *
             * ```php
             * \$email = 'john@example.com';
             * \$password = 'secret';
             * \$authenticatedUser = loginUser(\$email, \$password);
             * ```
             *
             * @description
             * This function is used to authenticate a user with the provided email and password.
             * It utilizes Laravel's built-in authentication system, attempting to log in the user.
             *
             * It may throw an exception if authentication fails or if there's an error during the process.
             */
            function loginUser(string \$email, string \$password)
            {
                try {
                    // Attempt to authenticate the user
                    if (Auth::attempt(['email' => \$email, 'password' => \$password])) {
                        // Authentication successful
                        return Auth::user();
                    } else {
                        // Authentication failed
                        throw new \Exception('Invalid credentials. Authentication failed.');
                    }
                } catch (\Exception \$e) {
                    // Log and rethrow the exception
                    Log::error(\$e->getMessage());
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $logoutUser = <<<EOT
            /**
             * Log out the currently authenticated user.
             *
             * This function logs out the user currently authenticated in the application.
             *
             * @return \Illuminate\Http\RedirectResponse
             *
             * @throws \Exception If an error occurs during the logout process.
             *
             * ```php
             * \$this->logoutUser();
             * ```
             *
             * @description
             * This function is used to log out the currently authenticated user. It does not require any parameters.
             *
             * The function returns a redirect response after successful logout. If an error occurs during the logout process,
             * an exception is thrown.
             */
            function logoutUser()
            {
                try {
                    Auth::logout();
                } catch (\Exception \$e) {
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $getAllRecords = <<<EOT
            /**
             * Retrieve all records from the specified Eloquent model.
             *
             * This function fetches all records from the given Eloquent model and returns them.
             *
             * @param string \$model The fully qualified class name of the Eloquent model.
             *
             * @return \Illuminate\Database\Eloquent\Collection|null The collection of records, or null if an error occurs.
             *
             * @throws \Exception If an error occurs during the retrieval process.
             *
             * ```php
             * \$records = getAllRecords(\App\Models\User::class);
             * ```
             *
             * @description
             * This function allows you to retrieve all records from a specified Eloquent model. It returns a collection of records
             * or null if an error occurs during the retrieval process.
             *
             * It may throw an exception if there's an error during the retrieval process.
             */
            function getAllRecords(string \$model)
            {
                try {
                    // Using the Eloquent model to retrieve all records
                    return \$model::all();
                } catch (\Exception \$e) {
                    // Log and rethrow the exception
                    Log::error(\$e->getMessage());
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $getRecordById = <<<EOT
            /**
             * Retrieve a single record from the specified Eloquent model by ID.
             *
             * This function fetches a record from the given Eloquent model based on the provided ID.
             *
             * @param string \$model The fully qualified class name of the Eloquent model.
             * @param int \$id The ID of the record to retrieve.
             *
             * @return \Illuminate\Database\Eloquent\Model|null The retrieved record, or null if not found.
             *
             * @throws \Exception If an error occurs during the retrieval process.
             *
             * ```php
             * \$user = getRecordById(\App\Models\User::class, 1);
             * ```
             *
             * @description
             * This function allows you to retrieve a single record from a specified Eloquent model based on the provided ID. It returns
             * the retrieved record or null if the record is not found.
             *
             * It may throw an exception if there's an error during the retrieval process.
             */
            function getRecordById(string \$model, int \$id)
            {
                try {
                    // Using the Eloquent model to retrieve a record by ID
                    return \$model::find(\$id);
                } catch (\Exception \$e) {
                    // Log and rethrow the exception
                    Log::error(\$e->getMessage());
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $deleteRecordById = <<<EOT
            /**
             * Delete a record from the specified Eloquent model by ID.
             *
             * This function deletes a record from the given Eloquent model based on the provided ID.
             *
             * @param string \$model The fully qualified class name of the Eloquent model.
             * @param int \$id The ID of the record to delete.
             *
             * @return bool True if the record is successfully deleted, false otherwise.
             *
             * @throws \Exception If an error occurs during the deletion process.
             *
             * ```php
             * \$isDeleted = deleteRecordById(\App\Models\User::class, 1);
             * ```
             *
             * @description
             * This function allows you to delete a record from a specified Eloquent model based on the provided ID. It returns
             * true if the record is successfully deleted, and false otherwise.
             *
             * It may throw an exception if there's an error during the deletion process.
             */
            function deleteRecordById(string \$model, int \$id): bool
            {
                try {
                    \$record = \$model::find(\$id);

                    if (\$record) {
                        return \$record->delete();
                    }
                    return false;
                } catch (\Exception \$e) {
                    // Log and rethrow the exception
                    Log::error(\$e->getMessage());
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $selectFirst = <<<EOT
            /**
             * Retrieve the first record from the specified model based on given conditions.
             *
             * This method is designed to fetch the first record from the database using Eloquent ORM.
             *
             *
             * ```php
             * \$result = selectFirst(User::class, ['id', 'name'], ['status' => 'active']);
             * ```
             *
             * @param  string \$model The fully qualified model class name.
             * @param  array|string \$columns The columns to select. Accepts either a string or an array of columns.
             * @param  array \$where An associative array representing the conditions for the WHERE clause.
             *
             * @return \Illuminate\Database\Eloquent\Model|null The first matching record or null if not found.
             *
             * @throws \Exception If an error occurs during the database query.
             */
            function selectFirst(\$model, \$columns, \$where = [])
            {
                try {
                    // Ensure \$columns is an array
                    \$columns = is_string(\$columns) ? [\$columns] : \$columns;

                    return \$model::select(\$columns)->where(\$where)->first();
                } catch (\Exception \$e) {
                    // Log or report the exception
                    report(\$e);

                    return null;
                }
            }\n \n \n
        EOT;

        $selectPaginate = <<<EOT
            /**
             * Retrieve paginated records from the specified model based on given conditions.
             *
             * This method is designed to paginate records from the database using Eloquent ORM.
             *
             * ```php
             * \$result = selectPaginate(User::class, ['id', 'name'], ['status' => 'active'], 10, 'created_at', 'desc');
             * ```
             *
             * @param  string \$model The fully qualified model class name.
             * @param  array|string \$columns The columns to select. Accepts either a string or an array of columns.
             * @param  array \$where An associative array representing the conditions for the WHERE clause.
             * @param  int \$paginateNumber The number of records per page.
             * @param  string|null \$orderBy_Column The column by which to order the results.
             * @param  string|null \$orderBy_Type The order direction ('asc' or 'desc').
             *
             * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null The paginated result set, or null on failure.
             * @throws \InvalidArgumentException If the \$orderBy_Type is not 'asc' or 'desc'.
             *
             * @description
             * This function retrieves paginated records from the specified Eloquent model based on given conditions.
             * The \$columns parameter can be either a string or an array of columns to select.
             * You can specify conditions using the \$where parameter, and control the pagination with \$paginateNumber.
             * The order of results can be customized using \$orderBy_Column and \$orderBy_Type.
             *
             * The method returns a LengthAwarePaginator instance containing the paginated result set.
             * If an error occurs during the process, it returns null and logs the exception.
             * Additionally, it throws an InvalidArgumentException if the \$orderBy_Type is not 'asc' or 'desc'.
             */
            function selectPaginate(\$model, \$columns, \$where = [], \$paginateNumber = 12, \$orderBy_Column = 'created_at', \$orderBy_Type = 'asc')
            {
                try {
                    // Ensure \$columns is an array
                    \$columns = is_string(\$columns) ? [\$columns] : \$columns;

                    // Validate\ \$orderBy_Type
                    if (\$orderBy_Type && !in_array(strtolower(\$orderBy_Type), ['asc', 'desc'])) {
                        throw new \InvalidArgumentException("Invalid order direction. Must be 'asc' or 'desc'.");
                    }

                    return \$model::select(\$columns)->where(\$where)->orderBy(\$orderBy_Column, \$orderBy_Type)->paginate(\$paginateNumber);
                } catch (\Exception \$e) {
                    // Log or report the exception
                    report(\$e);

                    return null;
                }
            }\n \n \n
        EOT;

        $changeUserPassword = <<<EOT
            /**
             * Change the password for the currently authenticated user.
             *
             * This function allows the currently authenticated user to change their password. It checks the old password
             * before updating to ensure the user's identity.
             *
             * @param string \$oldPassword The old password for verification.
             * @param string \$newPassword The new password to set for the user.
             *
             * @return bool True on successful password change, false otherwise.
             *
             * @throws \Exception If an error occurs during the password change process.
             *
             * ```php
             * \$oldPassword = 'current_password';
             * \$newPassword = 'new_secure_password';
             * \$this->changeUserPassword(\$oldPassword, \$newPassword);
             * ```
             *
             * @description
             * This function is used to change the password for the currently authenticated user. It requires the old password
             * for verification and the new password as parameters.
             *
             * The function returns true on successful password change, false otherwise. If an error occurs during the password change
             * process, an exception is thrown.
             */
            function changeUserPassword(string \$oldPassword, string \$newPassword)
            {
                try {
                    \$user = Auth::user();

                    if (\$user && Hash::check(\$oldPassword, \$user->password)) {
                        User::where('id', \$user->id)->update(['password' => Hash::make(\$newPassword)]);
                    } else {
                        // Handle the case when there is no authenticated user or the old password is incorrect
                        return false;
                    }
                } catch (\Exception \$e) {
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $selectRandomWithPaginate = <<<EOT
            /**
             * Retrieve paginated records from the specified model in random order based on given conditions.
             *
             * This method is designed to paginate records from the database using Eloquent ORM.
             * The records will be retrieved in random order.
             *
             * ```php
             * \$result = selectRandomOrderWithPaginate(User::class, ['id', 'name'], ['status' => 'active'], 10);
             * ```
             *
             * @param  string \$model The fully qualified model class name.
             * @param  array|string \$columns The columns to select. Accepts either a string or an array of columns.
             * @param  array \$where An associative array representing the conditions for the WHERE clause.
             * @param  int \$paginateNumber The number of records per page.
             *
             * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null The paginated result set, or null on failure.
             *
             * @description
             * This function retrieves paginated records from the specified Eloquent model in random order based on given conditions.
             * The \$columns parameter can be either a string or an array of columns to select.
             * You can specify conditions using the \$where parameter, and control the pagination with \$paginateNumber.
             *
             * The method returns a LengthAwarePaginator instance containing the paginated result set.
             * If an error occurs during the process, it returns null and logs the exception.
             */
            function selectRandomWithPaginate(\$model, \$columns, \$where = [], \$paginateNumber = 12)
            {
                try {
                    // Ensure \$columns is an array
                    \$columns = is_string(\$columns) ? [\$columns] : \$columns;

                    return \$model::select(\$columns)->where(\$where)->inRandomOrder()->paginate(\$paginateNumber);
                } catch (\Exception \$e) {
                    // Log or report the exception
                    report(\$e);

                    return null;
                }
            }\n \n \n
        EOT;

        $attemptAuthentication = <<<EOT
            /**
             * Attempt user authentication based on the provided credentials.
             *
             * This method attempts to authenticate a user using the provided email and password.
             *
             * @param \Illuminate\Http\Request \$request The HTTP request containing user credentials.
             *
             * @return bool True if the authentication attempt succeeds, false otherwise.
             *
             * @throws \Exception If an error occurs during the authentication attempt.
             *
             * ```php
             * \$request = new Request(['email' => 'user@example.com', 'password' => 'password123']);
             * \$result = attemptAuthentication(\$request);
             * ```
             *
             * @description
             * This function attempts to authenticate a user based on the provided credentials.
             * It uses the `Auth::attempt` method to check if the email and password combination is valid.
             *
             * The `\$request` parameter should be an instance of the `Illuminate\Http\Request` class
             * and should contain the 'email' and 'password' fields.
             *
             * The function returns a boolean value indicating whether the authentication attempt succeeded or failed.
             * If successful, it returns true; otherwise, it returns false.
             *
             * It may throw an `\Exception` if an error occurs during the authentication attempt.
             */
            function attemptAuthentication(Request \$request)
            {
                try {
                    \$credentials = \$request->only('email', 'password');
                    return Auth::attempt(\$credentials);
                } catch (\Exception \$e) {
                    report(\$e);
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $uploadFile = <<<EOT
            /**
             * Upload a file to the specified folder with customizable file types.
             *
             * This function allows you to upload a file to a specified folder with support for different file types.
             *
             * @param array|string \$type         The allowed file types. It can be an array of types or a single type ('pdf' or 'image').
             * @param \Illuminate\Http\UploadedFile \$file The file to be uploaded.
             * @param string \$path_Folder        The relative path of the folder where the file will be stored.
             *
             * @return string|null The generated filename if the upload is successful, null otherwise.
             *
             * @throws \InvalidArgumentException If an invalid file type is provided.
             * @throws \Exception If an error occurs during the file upload process.
             *
             * ```php
             * \$allowedTypes = ['pdf', 'image'];
             * \$file = \$request->file('file');
             * \$folderPath = 'uploads';
             * \$result = uploadFile(\$allowedTypes, \$file, \$folderPath);
             * ```
             *
             * @description
             * This function allows you to upload a file to a specified folder with customizable file types.
             * The supported file types are provided in the `\$type` parameter, which can be an array of types or a single type.
             *
             * The `\$file` parameter should be an instance of the `\Illuminate\Http\UploadedFile` class obtained from the request.
             * The `\$path_Folder` parameter is the relative path of the folder where the file will be stored.
             *
             * The function returns the generated filename if the upload is successful, or null if the upload fails.
             *
             * It may throw an `\InvalidArgumentException` if an invalid file type is provided, and it may throw an `\Exception`
             * if an error occurs during the file upload process.
             */
            function uploadFile(\$allowedType, UploadedFile \$file, string \$path_Folder): ?string
            {
                try {
                    \$allowedTypes = is_array(\$allowedType) ? \$allowedType : [\$allowedType];

                    \$extension = strtolower(\$file->extension());
                    if (!in_array(\$extension, \$allowedTypes)) {
                        throw new \InvalidArgumentException('Invalid file type. Allowed types are: ' . implode(', ', \$allowedTypes));
                    }

                    \$filename = time() . rand(1, 10000) . '.' . \$extension;
                    \$file->move(public_path(\$path_Folder), \$filename);

                    return \$filename;
                } catch (\Exception \$e) {
                    report(\$e);
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $eliminatePreviousImage = <<<EOT
            /**
             * Delete the previous user image and retrieve its name.
             *
             * This method deletes the previous image associated with a user, identified by the provided user ID, from the specified
             * column and folder path. It then retrieves and returns the name of the deleted image. If no image was deleted or an
             * error occurred during the deletion process, it returns null.
             *
             * @param int         \$userId          The ID of the user.
             * @param string      \$columnName      The column name containing the image name.
             * @param string|null \$imageFolderPath The folder path where the image is stored (default: 'images').
             *
             * @return string|null The name of the deleted image, or null if no image was deleted.
             *
             * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the user with the given ID is not found.
             * @throws \Exception If an error occurs during the image deletion process.
             *
             * ```php
             * \$imageName = \$this->eliminatePreviousImage(1, 'profile_image', 'Folder_path');
             * ```
             *
             * @description
             * This method is used to delete the previous image associated with a user and retrieve its name. It requires the user's
             * ID, the column name containing the image name, and the optional folder path where the image is stored.
             *
             * If the image is successfully deleted, the name of the deleted image is returned. If no image is deleted or an error
             * occurs during the deletion process, null is returned.
             *
             * The method may throw a \Illuminate\Database\Eloquent\ModelNotFoundException if the user with the given ID is not found,
             * and it may throw an \Exception if an error occurs during the image deletion process.
             */
            function eliminatePreviousImage(int \$userId, string \$columnName, string \$imageFolderPath = 'images'): ?string
            {
                try {
                    \$user = User::findOrFail(\$userId);

                    \$oldImageName = \$user->{\$columnName};

                    if (\$oldImageName) {
                        \$imagePath = public_path("{\$imageFolderPath}/{\$oldImageName}");

                        if (File::exists(\$imagePath)) {
                            File::delete(\$imagePath);
                        }
                    }

                    return \$oldImageName;
                } catch (ModelNotFoundException \$e) {
                    Log::error("User with ID {\$userId} not found.");
                } catch (\Exception \$e) {
                    Log::error(\$e->getMessage());
                }

                return null;
            }
        EOT;

        $generateRandomString = <<<EOT
            /**
             * Generate a random string with a specified length.
             *
             * This function generates a random string using a combination of letters (both uppercase and lowercase) and numbers.
             *
             * @param int \$length The length of the random string to generate.
             *
             * @return string The generated random string.
             *
             * @throws \Exception If unable to generate a random string.
             *
             * ```php
             * \$randomString = generateRandomString(10);
             * echo \$randomString; // Output: "3aB8fR2hZs"
             * ```
             *
             * @description
             * This function generates a random string of the specified length. It uses the `random_bytes` function
             * to generate a secure random string, and the resulting bytes are converted to a string containing a
             * combination of letters (both uppercase and lowercase) and numbers.
             *
             * If the generation process fails, an `\Exception` is thrown.
             */
            function generateRandomString(int \$length): string
            {
                try {
                    \$bytes = random_bytes(\$length);
                    \$randomString = bin2hex(\$bytes);
                    return \$randomString;
                } catch (\Exception \$e) {
                    // Log or handle the exception as needed
                    throw new \Exception("Failed to generate a random string.");
                }
            }\n \n \n
        EOT;

        $calculateAge = <<<EOT
            /**
             * Calculate the age based on the given birthdate.
             *
             * @param string \$birthdate The birthdate in the format 'YYYY-MM-DD'.
             *
             * @return int|null The calculated age, or null if the birthdate is invalid.
             *
             * @throws \Exception If an error occurs during the age calculation.
             *
             * ```php
             * \$birthdate = '1990-05-15';
             * \$age = calculateAge(\$birthdate);
             * echo \$age; // Output: 31 (depending on the current date)
             * ```
             *
             * @description
             * This function takes a birthdate in the format 'YYYY-MM-DD' and calculates the age based on the current date.
             * It returns the calculated age as an integer or null if the birthdate is invalid.
             * An \Exception is thrown if an error occurs during the age calculation.
             */
            function calculateAge(string \$birthdate): ?int
            {
                try {
                    \$today = new DateTime();
                    \$birthDate = new DateTime(\$birthdate);
                    \$age = \$today->diff(\$birthDate)->y;

                    return \$age;
                } catch (Exception \$e) {
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $formatCurrency = <<<EOT
            /**
             * Format a numeric value as a currency string.
             *
             * @param float \$amount The numeric value to be formatted.
             * @param string \$currencyCode The ISO 4217 currency code (e.g., 'USD', 'EUR').
             *
             * @return string|null The formatted currency string, or null if the input is invalid.
             *
             * @throws \InvalidArgumentException If an invalid currency code is provided.
             *
             * ```php
             * \$amount = 1234.56;
             * \$currencyCode = 'USD';
             * \$formattedAmount = formatCurrency(\$amount, \$currencyCode);
             * echo \$formattedAmount; // Output: $1,234.56
             * ```
             *
             * @description
             * This function takes a numeric value and a currency code, then formats the value as a currency string.
             * The result is returned as a string with the specified currency symbol and formatted according to the locale.
             *
             * It throws an \InvalidArgumentException if an invalid currency code is provided.
             */
            function formatCurrency(float \$amount, string \$currencyCode): ?string
            {
                try {
                    \$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
                    \$formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, \$currencyCode);

                    return \$formatter->formatCurrency(\$amount, \$currencyCode);
                } catch (Exception \$e) {
                    throw new InvalidArgumentException('Invalid currency code provided.', 0, \$e);
                }
            }\n \n \n
        EOT;

        $generateUniqueCode = <<<EOT
            /**
             * Generate a unique alphanumeric code of a specified length.
             *
             * @param int \$length The length of the generated code.
             *
             * @return string The generated unique code.
             *
             * @throws \InvalidArgumentException If an invalid length is provided.
             *
             * @example
             * ```php
             * \$codeLength = 8;
             * \$uniqueCode = generateUniqueCode(\$codeLength);
             * echo \$uniqueCode; // Output: A1b2C3d4
             * ```
             *
             * @description
             * This function generates a unique alphanumeric code of the specified length. The resulting code
             * contains a mix of uppercase letters, lowercase letters, and digits.
             *
             * It throws an \InvalidArgumentException if an invalid length is provided.
             */
            function generateUniqueCode(int \$length): string
            {
                if (\$length <= 0) {
                    throw new InvalidArgumentException('Invalid code length. Length must be greater than zero.');
                }

                \$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                \$code = '';

                for (\$i = 0; \$i < \$length; \$i++) {
                    \$code .= \$characters[random_int(0, strlen(\$characters) - 1)];
                }

                return\$code;
            }\n \n \n
        EOT;

        $generateDashNumericCode = <<<EOT
            /**
             * Generate a unique numeric code of length 10 with a dash after every specified number of digits.
             *
             * @param int \$digitsBeforeDash The number of digits before a dash.
             *
             * @return string The generated unique numeric code.
             *
             * @throws \InvalidArgumentException If an invalid number of digits is provided.
             *
             * ```php
             * \$digitsBeforeDash = 2;
             * \$uniqueNumericCode = generateDashNumericCode(\$digitsBeforeDash);
             * echo \$uniqueNumericCode; // Output: 45-67-89-01-42
             * ```
             *
             * @description
             * This function generates a unique numeric code of length 10 with a dash after every specified number of digits.
             *
             * It throws an \InvalidArgumentException if an invalid number of digits is provided.
             */
            function generateDashNumericCode(int \$digitsBeforeDash): string
            {
                if (\$digitsBeforeDash <= 0 || \$digitsBeforeDash >= 10) {
                    throw new InvalidArgumentException('Invalid number of digits before dash. Must be between 1 and 9.');
                }

                \$digits = range(0, 9);
                shuffle(\$digits);

                // Insert a dash after every specified number of digits
                \$codeDigits = [];
                while (\$digits) {
                    \$chunk = array_splice(\$digits, 0,\$digitsBeforeDash);
                    \$codeDigits[] = implode('', \$chunk);
                }

                // Join the digits with dashes to form the final code
                \$code = implode('-', \$codeDigits);

                return \$code;
            }\n \n \n
        EOT;

        $generateQRCode = <<<EOT
            /**
             * Generate a QR code for the provided data with customization options.
             *
             * This function generates a QR code for the given data using the SimpleSoftwareIO/simple-qrcode package. It provides
             * options to customize the QR code's size, foreground color, and background color.
             *
             * @param string \$data The data to encode in the QR code.
             * @param int \$size The size of the QR code (default is 200).
             * @param array \$foregroundColor The RGB color for the foreground (default is [0, 0, 0]).
             * @param array \$backgroundColor The RGB color for the background (default is [255, 255, 255]).
             *
             * @return \SimpleSoftwareIO\QrCode\Facades\QrCode The generated QR code instance.
             *
             * @throws \Exception If an error occurs during QR code generation.
             *
             * ```php
             * \$data = 'https://example.com';
             * \$size = 300;
             * \$foregroundColor = [0, 128, 255];
             * \$backgroundColor = [255, 255, 255];
             * \$qrCode = generateQRCode(\$data, \$size, \$foregroundColor, \$backgroundColor);
             * ```
             *
             * @description
             * This function generates a QR code for the provided data with customization options. The QR code's size, foreground
             * color, and background color can be customized by providing the appropriate parameters.
             *
             * The function returns the generated QR code instance. If an error occurs during the generation process, an exception
             * is thrown.
             */
            function generateQRCode(
                string \$data,
                int \$size = 200,
                array \$foregroundColor = [0, 0, 0],
                array \$backgroundColor = [255, 255, 255]
            ) {
                try {
                    return \SimpleSoftwareIO\QrCode\Facades\QrCode::size(\$size)
                        ->color(\$foregroundColor[0], \$foregroundColor[1], \$foregroundColor[2])
                        ->backgroundColor(\$backgroundColor[0], \$backgroundColor[1], \$backgroundColor[2])
                        ->generate(\$data);
                } catch (\Exception \$e) {
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $generateUniqueName = <<<EOT
            /**
             * Generate a unique username based on the provided name.
             *
             * This function takes a name and generates a unique username by appending a random number to it.
             *
             * @param string \$name The name to generate a username from.
             *
             * @return string The unique username.
             *
             * @throws \Exception If an error occurs during the username generation.
             *
             * ```php
             *     \$name = 'JohnDoe';
             *     \$username = generateUniqueUsername(\$name);
             * ```
             *
             * @description
             * This function generates a unique username based on the provided name. It appends a random number to the name to ensure
             * uniqueness. The resulting username is returned.
             */
            function generateUniqueUsername(string \$name): string
            {
                try {
                    // Generate a random number between 1000 and 9999
                    \$randomNumber = rand(1000, 9999);

                    // Append the random number to the name
                    \$username = \$name . \$randomNumber;

                    return \$username;
                } catch (\Exception \$e) {
                    // Log the exception or perform error handling
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $cacheData = <<<EOT
            /**
             * Cache the provided data with an optional expiration time.
             *
             * This function allows you to cache data using Laravel's caching mechanism.
             *
             * @param string \$key The cache key.
             * @param mixed \$data The data to be cached.
             * @param int|null \$minutes The number of minutes the data should be cached (default is null, meaning forever).
             *
             * @throws \Exception If an error occurs during the caching process.
             *
             * ```php
             *     \$cacheKey = 'example_key';
             *     \$data = ['example' => 'data'];
             *     \$minutes = 60; // Cache for 60 minutes
             *     cacheData(\$cacheKey, \$data, \$minutes);
             * ```
             *
             * @description
             * This function allows you to cache data with a specified key and optional expiration time. The cached data can be
             * retrieved later using the same key. If an error occurs during the caching process, an exception is thrown.
             */
            function cacheData(string \$key, \$data, ?int \$minutes = null): void
            {
                try {
                    // Cache the data using Laravel's cache system
                    cache([\$key => \$data], \$minutes);
                } catch (\Exception \$e) {
                    // Log the exception or perform error handling
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $getDataFromCache = <<<EOT
            /**
             * Retrieve data from the cache.
             *
             * This function retrieves data from the cache using the provided key.
             *
             * @param string \$key The cache key.
             *
             * @return mixed|null The cached data, or null if the data is not found.
             *
             * @throws \Exception If an error occurs during the retrieval process.
             *
             * ```php
             *     \$cacheKey = 'example_key';
             *     \$cachedData = getDataFromCache(\$cacheKey);
             * ```
             *
             * @description
             * This function allows you to retrieve data from the cache using the specified key. If the data is found, it is returned.
             * If the data is not found or an error occurs during the retrieval process, null is returned.
             */
            function getDataFromCache(string \$key)
            {
                try {
                    // Retrieve data from the cache using Laravel's cache system
                    return cache(\$key);
                } catch (\Exception \$e) {
                    // Log the exception or perform error handling
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $clearCache = <<<EOT
            /**
             * Clear the Laravel application cache.
             *
             * This function clears various types of caches in the Laravel application.
             *
             * @throws \Exception If an error occurs during the cache clearing process.
             *
             * ```php
             *     clearCache();
             * ```
             *
             * @description
             * This function allows you to clear various types of caches in the Laravel application. It uses Laravel's Artisan command
             * to perform cache clearing. If an error occurs during the cache clearing process, an exception is thrown.
             */
            function clearCache()
            {
                try {
                    // Clear various types of caches using Artisan commands
                    Artisan::call('cache:clear');
                    Artisan::call('config:clear');
                    Artisan::call('route:clear');
                    Artisan::call('view:clear');

                    // You can add more cache clearing commands as needed

                } catch (\Exception \$e) {
                    // Log the exception or perform error handling
                    throw \$e;
                }
            }\n \n \n
        EOT;

        $cohereAPI = <<<EOT
        function cohereAPI(\$prompt, \$maxTokens = 50, \$temperature = 0.7, \$model = 'command-xlarge-nightly')
        {
            \$apiKey = env('COHERE_API_KEY');
            \$endpoint = 'https://api.cohere.ai/generate';

            \$response = Http::withHeaders([
                'Authorization' => 'Bearer ' . \$apiKey,
                'Content-Type' => 'application/json',
            ])->post(\$endpoint, [
                'model' => \$model,
                'prompt' => \$prompt,
                'max_tokens' => \$maxTokens,
                'temperature' => \$temperature,
            ]);

            if (\$response->successful()) {
                return \$response->json()['text'];
            } else {
                throw new \Exception(\$response->json()['message']);
            }
        }
EOT;



        // START
        $baseControllerContent .= $use;

        // OPEN CLASS
        $baseControllerContent .= $openClass;

        // READY
        echo "\n";
        sleep(1);
        echo "Creating BaseController...\n";
        sleep(1);
        echo "Working...\n";
        sleep(1);
        echo "\n";

        // 1
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Redirect with message function");
        }
        $baseControllerContent .= $redirectWithMessage;
        echo "\n";
        // 2
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Redirect back function");
        }
        $baseControllerContent .= $redirectBack;
        echo "\n";

        // 3
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Redirect back with message function");
        }
        $baseControllerContent .= $backWithMessage;
        echo "\n";

        // 4
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Simple redirect function");
        }
        $baseControllerContent .= $simpleRedirect;
        echo "\n";

        // 5
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Set and get from request function");
        }
        $baseControllerContent .= $getFromRequest;
        echo "\n";

        // 6
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Set and get file from request function");
        }
        $baseControllerContent .= $GetFileFromRequest;
        echo "\n";

        // 7
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Create record function");
        }
        $baseControllerContent .= $createRecord;
        echo "\n";

        // 8
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Update record function");
        }
        $baseControllerContent .= $updateRecord;
        echo "\n";

        // 9
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Delete record function");
        }
        $baseControllerContent .= $deleteRecord;
        echo "\n";

        // 10
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Return view with data function");
        }
        $baseControllerContent .= $viewWithData;
        echo "\n";

        // 11
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Register user function");
        }
        $baseControllerContent .= $registerUser;
        echo "\n";

        // 12
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Register and authenticate user function");
        }
        $baseControllerContent .= $registerAndAuthenticateUser;
        echo "\n";

        // 13
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Login user function");
        }
        $baseControllerContent .= $loginUser;
        echo "\n";

        // 14
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Logout user function");
        }
        $baseControllerContent .= $logoutUser;
        echo "\n";

        // 15
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Get all record function");
        }
        $baseControllerContent .= $getAllRecords;
        echo "\n";

        // 16
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Get record  by id function");
        }
        $baseControllerContent .= $getRecordById;
        echo "\n";

        // 17
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Delete record by id function");
        }
        $baseControllerContent .= $deleteRecordById;
        echo "\n";

        // 18
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Select first record function");
        }
        $baseControllerContent .= $selectFirst;
        echo "\n";

        // 19
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Select records with pagination function");
        }
        $baseControllerContent .= $selectPaginate;
        echo "\n";

        // 20
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Change password function");
        }
        $baseControllerContent .= $changeUserPassword;
        echo "\n";

        // 21
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "select random record with pagination function");
        }
        $baseControllerContent .= $selectRandomWithPaginate;
        echo "\n";

        // 22
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Attempt authentication function");
        }
        $baseControllerContent .= $attemptAuthentication;
        echo "\n";

        // 23
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Upload file function");
        }
        $baseControllerContent .= $uploadFile;
        echo "\n";

        // 24
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Remove old image function");
        }
        $baseControllerContent .= $eliminatePreviousImage;
        echo "\n";

        // 25
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Generate random string function");
        }
        $baseControllerContent .= $generateRandomString;
        echo "\n";

        // 26
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Calculate age function");
        }
        $baseControllerContent .= $calculateAge;
        echo "\n";

        // 27
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Format currency function");
        }
        $baseControllerContent .= $formatCurrency;
        echo "\n";

        // 28
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Generate unique code function");
        }
        $baseControllerContent .= $generateUniqueCode;
        echo "\n";

        // 29
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Generate dash numeric code function");
        }
        $baseControllerContent .= $generateDashNumericCode;
        echo "\n";

        // 29
        if ($this->confirm('Do you want to download the QR code generator function?')) {
            $composerRequireCommand = 'composer require simplesoftwareio/simple-qrcode';
            exec($composerRequireCommand, $output, $returnValue);

            // Check if the command executed successfully
            if ($returnValue === 0) {
                echo "Package downloaded successfully.\n";
            } else {
                echo "Failed to download the package.\n";
                echo "Error output:\n";
                echo implode("\n", $output);
            }
            for ($i = 0; $i <= 100; $i += 10) {
                updateProgress($i, "Generate QR code function");
            }
            $baseControllerContent .= $generateQRCode;

            echo "\n";
        }

        // 30
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Generate unique name function");
        }
        $baseControllerContent .= $generateUniqueName;
        echo "\n";

        // 31
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Cache data function");
        }
        $baseControllerContent .= $cacheData;
        echo "\n";

        // 32
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Get data from cache function");
        }
        $baseControllerContent .= $getDataFromCache;
        echo "\n";

        // 33
        for ($i = 0; $i <= 100; $i += 10) {
            updateProgress($i, "Clear cache function");
        }
        $baseControllerContent .= $clearCache;
        echo "\n";

        // 34
        if ($this->confirm('Do you want to download the cohere Api (ai) function?')) {

            for ($i = 0; $i <= 100; $i += 10) {
                updateProgress($i, "Generate cohereAPI function");
            }
            $baseControllerContent .= $cohereAPI;

            echo "\n";
        }


        //
        $baseControllerContent .= $closeClass;

        // Save the BaseController file
        File::put($baseControllerPath, $baseControllerContent);

        $this->info('BaseController generated successfully.');
    }

    protected function installQRCodePackage()
    {
        // Run the composer require command to install the QR code package
        Artisan::call('composer require simplesoftwareio/simple-qrcode');
        $this->info('QR code package installed successfully!');
    }
}
