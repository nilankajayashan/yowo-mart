<h1 class="">My Addresses &nbsp; </h1>
<!-- Button trigger modal -->
<button type="button" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Address
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-address') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" placeholder="Country" name="country" class="form-control @error('country') is-invalid @enderror" required="required">
                        @error('country')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="District" name="district" class="form-control @error('district') is-invalid @enderror" required="required">
                        @error('district')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="City" name="city" class="form-control @error('city') is-invalid @enderror" required="required">
                        @error('city')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="Postal Code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" required="required">
                        @error('postal_code')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="Address | House,Office Number" name="address" class="form-control @error('address') is-invalid @enderror" required="required">
                        @error('address')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn col-12 @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif float-end">Save Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($addresses) && $addresses != null)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#Address</th>
            <th scope="col">Country</th>
            <th scope="col">District</th>
            <th scope="col">City</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($addresses as $address)
            <tr>
                <th scope="row">{{ ucwords($address->address) }}</th>
                <td>{{ ucwords($address->country) }}</td>
                <td>{{ ucwords($address->district) }}</td>
                <td>{{ ucwords($address->city .'('.$address->postal_code.')') }}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn-icon" data-bs-toggle="modal" data-bs-target="#editAddress">
                        <i class="fas fa-marker @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif"></i>&nbsp;Edit
                    </button>
                    |
                    <form action="{{ route('delete-address') }}" method="post" class="d-lg-inline-flex">
                        @csrf
                        <input type="hidden" name="address_id" value="{{$address->id}}">
                        <button type="submit" class="btn-icon">
                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>&nbsp;Delete
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="editAddress" tabindex="-1" aria-labelledby="editAddressLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('update-address') }}" method="post">
                                @csrf
                                <input type="hidden" name="address_id" value="{{ $address->id }}">
                                <div class="mb-3">
                                    <input type="text" placeholder="Country" name="country" class="form-control @error('update_country') is-invalid @enderror" required="required" value="{{ $address->country }}">
                                    @error('update_country')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" placeholder="District" name="district" class="form-control @error('update_district') is-invalid @enderror" required="required" value="{{ $address->district }}">
                                    @error('update_district')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" placeholder="City" name="city" class="form-control @error('update_city') is-invalid @enderror" required="required" value="{{ $address->city }}">
                                    @error('update_city')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" placeholder="Postal Code" name="postal_code" class="form-control @error('update_postal_code') is-invalid @enderror" required="required" value="{{ $address->postal_code }}">
                                    @error('update_postal_code')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" placeholder="Address | House,Office Number" name="address" class="form-control @error('update_address') is-invalid @enderror" required="required" value="{{ $address->address }}">
                                    @error('update_address')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif  float-end col-12">Update Address</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
            No Addresses in your Account
        </div>
    </div>
@endif
