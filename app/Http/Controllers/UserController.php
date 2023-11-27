<?php
/**
 * @copyright (c) 2023 ${PROJECT_NAME}
 * @author    Dr. Manuel Lamotte-Schubert, pronego (https://www.pronego.com)
 * @date      2023-09-22 23:25
 */

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
	use PasswordValidationRules;

    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()
				// Append to query when input search is given
				->when($request->input('search'), function($query, $search) {
					$query->where('name', 'like', "%$search%");
				})

				->paginate(3) // pagination limit
				->onEachSide(1) // definition on how many pages to show around current page
				->withQueryString() // includes current query string for pagination links

				// Use 'through' to modify the current collection (with ->map(), we would replace it with a new array)
				// Reason: provide only the fields we want to pass through, otherwise all model fields would be sent
				->through(fn ($user) => [
					'id' => $user->id,
					'firstname' => $user->firstname,
					'lastname' => $user->lastname,
					'email' => $user->email,
					'active' => $user->active,

					// Provide auth information about the single record
					// Key name is arbitrary, good practice: use 'can'
					'can' => [
						'edit' => Auth::user()->can('edit', $user)
					]
				]),

			'filters' => $request->only(['search']), // send a list of approved filters to the client, see defineProps() on client
			'can' => [
				'createUser' => Auth::user()->can('create', User::class)
	]
        ]);
    }

	public function create()
	{
		return Inertia::render('Users/Create');
	}

	public function store(Request $request)
	{
		// Less mandatory fields for initial registration (compared to edit)
		$validated = $request->validate([
			'username' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:'.User::class,
			'password' => ['required', 'confirmed', $this->passwordRules()],
			'active' => 'boolean',
			//'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
		]);

		User::create($validated);

		return redirect('users');
	}

	public function edit(User $user = null)
	{
		return Inertia::render('Users/Edit', compact('user'));
	}

	public function update(UserEditRequest $request, User $user)
	{
		$validated = $request->validated();

		// Alternative to get validated data:
		// $validated = $request->safe()->all();

		// Further examples:
		// * Add additional fields to validated data
		//      $request->safe()->merge(['status' => '1l']);
		// * Subset of the validated data
		//      $request->safe()->only(['name', 'email']);
		//      $request->safe()->except(['name', 'email']);

		$user->update($validated);

		return redirect('users');
	}
}
