<x-layouts :categories="$categories">
    <x-slot name="title">Sign Up</x-slot>

    <div class="row g-5 p-5">
        <div class="col-md-8 p-5 bg-light rounded">
            <h4 class="mb-3">Sign In Form</h4>

            {{--<x-signup-error/>--}}

            <x-success-msg />

            <form class="needs-validation" method="post" action="{{ route('login') }}" novalidate="">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="" value="{{ old('email') }}">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="" value="{{ old('password') }}">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-lg btn-block mt-4" type="submit">Sign In</button>
            </form>
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <x-about/>

                <x-archives />

                <x-elsewhere />
            </div>
        </div>
    </div>

</x-layouts>
