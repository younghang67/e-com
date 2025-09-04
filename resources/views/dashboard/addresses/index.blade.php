@extends('layouts.dashboard')

@section('title', 'Address Book')

@section('breadcrumb')
    <span class="mx-2 text-gray-400">/</span>
    <span class="text-gray-800">Address Book</span>
@endsection

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Address Book</h1>
            <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="document.getElementById('add-address-modal').classList.remove('hidden')">
                <i class="fas fa-plus mr-2"></i>
                Add New Address
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(count($addresses) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($addresses as $address)
                    <div class="bg-white rounded-lg shadow-sm p-6 relative">
                        @if($address->is_default)
                            <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Default
                            </span>
                            </div>
                        @endif

                        <h3 class="font-medium">{{ $address->name }}</h3>
                        <div class="text-gray-600 mt-2">
                            {{ $address->address_line1 }}<br>
                            @if($address->address_line2)
                                {{ $address->address_line2 }}<br>
                            @endif
                            {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}<br>
                            {{ $address->country }}<br>
                            Phone: {{ $address->phone }}
                        </div>

                        <div class="mt-4 flex space-x-3">
                            <button type="button" class="text-sm text-blue-600 hover:text-blue-800" onclick="openEditModal({{ $address->id }})">
                                Edit
                            </button>

                            @if(!$address->is_default)
                                <form action="{{ route('dashboard.addresses.default', $address->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-800">
                                        Set as Default
                                    </button>
                                </form>
                            @endif

                            @if(!$address->is_default)
                                <form action="{{ route('dashboard.addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <div class="text-5xl mb-4 text-gray-300">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="text-lg font-medium mb-2">No addresses yet</h3>
                <p class="text-gray-500 mb-4">You haven't added any addresses to your address book yet.</p>
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="document.getElementById('add-address-modal').classList.remove('hidden')">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Address
                </button>
            </div>
        @endif

        <!-- Add Address Modal -->
        <div id="add-address-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('dashboard.addresses.store') }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Address</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                </div>

                                <div>
                                    <label for="address_line1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line1" id="address_line1" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                </div>

                                <div>
                                    <label for="address_line2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line2" id="address_line2" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" id="city" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                    </div>

                                    <div>
                                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                        <input type="text" name="state" id="state" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal/ZIP Code</label>
                                        <input type="text" name="postal_code" id="postal_code" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                    </div>

                                    <div>
                                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                        <select name="country" id="country" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                            <option value="">Select a country</option>
                                            <option value="US">United States</option>
                                            <option value="CA">Canada</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="AU">Australia</option>
                                            <option value="IN">India</option>
                                            <!-- Add more countries as needed -->
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                </div>

                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_default" class="mr-2">
                                        <span class="text-sm text-gray-700">Set as default address</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save Address
                            </button>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('add-address-modal').classList.add('hidden')">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Address Modal -->
        <div id="edit-address-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form id="edit-address-form" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Address</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" id="edit_name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                </div>

                                <div>
                                    <label for="edit_address_line1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line1" id="edit_address_line1" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                </div>

                                <div>
                                    <label for="edit_address_line2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line2" id="edit_address_line2" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="edit_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" id="edit_city" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                    </div>

                                    <div>
                                        <label for="edit_state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                        <input type="text" name="state" id="edit_state" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="edit_postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal/ZIP Code</label>
                                        <input type="text" name="postal_code" id="edit_postal_code" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                    </div>

                                    <div>
                                        <label for="edit_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                        <select name="country" id="edit_country" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                            <option value="">Select a country</option>
                                            <option value="US">United States</option>
                                            <option value="CA">Canada</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="AU">Australia</option>
                                            <option value="IN">India</option>
                                            <!-- Add more countries as needed -->
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="edit_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" name="phone" id="edit_phone" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-200" required>
                                </div>

                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_default" id="edit_is_default" class="mr-2">
                                        <span class="text-sm text-gray-700">Set as default address</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Update Address
                            </button>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('edit-address-modal').classList.add('hidden')">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function openEditModal(addressId) {
                // In a real application, you would fetch the address data from the server
                // For this demo, we'll use dummy data
                const addressData = {
                    id: addressId,
                    name: 'John Doe',
                    address_line1: '123 Main St',
                    address_line2: 'Apt 4B',
                    city: 'New York',
                    state: 'NY',
                    postal_code: '10001',
                    country: 'US',
                    phone: '555-123-4567',
                    is_default: false
                };

                // Set form action
                document.getElementById('edit-address-form').action = `/dashboard/addresses/${addressId}`;

                // Fill form fields
                document.getElementById('edit_name').value = addressData.name;
                document.getElementById('edit_address_line1').value = addressData.address_line1;
                document.getElementById('edit_address_line2').value = addressData.address_line2;
                document.getElementById('edit_city').value = addressData.city;
                document.getElementById('edit_state').value = addressData.state;
                document.getElementById('edit_postal_code').value = addressData.postal_code;
                document.getElementById('edit_country').value = addressData.country;
                document.getElementById('edit_phone').value = addressData.phone;
                document.getElementById('edit_is_default').checked = addressData.is_default;

                // Show modal
                document.getElementById('edit-address-modal').classList.remove('hidden');
            }
        </script>
    @endsection
@endsection
