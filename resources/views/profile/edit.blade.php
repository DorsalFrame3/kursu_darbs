<x-app-layout>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <div class="details-info">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="details-info">
                    @include('profile.partials.update-password-form')
                </div>
                        
                <div class="details-info">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
