@isset($edit)
    @php
        $ed = $edit ? true : false;
    @endphp
@else
    @php
        $ed = false
    @endphp
@endisset

<form method="POST" action="{{$ed?route('updateprofile'):route('createprofile')}}">
    @csrf
    @isset($edit)
        @method('PUT')
    @endisset
    <div>
        <p>First name</p>
        <input type="text" name="firstname" value='{{$ed ? $profile->firstname:old('firstname')}}'>
        @error('firstname')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Last name</p>
        <input type="text" name="lastname" value='{{$ed ? $profile->lastname:old('lastname')}}'>
        @error('lastname')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Country</p>
        <input type="text" name="country" value='{{$ed ? $profile->country:old('country')}}'>
        @error('country')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>City</p>
        <input type="text" name="city" value='{{$ed ? $profile->city:old('city')}}'>
        @error('city')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>State</p>
        <input type="text" name="state" value='{{$ed ? $profile->state:old('state')}}'>
        @error('state')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Twitter</p>
        <input type="text" name="twitter" value='{{$ed ? $profile->twitter:old('twitter')}}'>
        @error('twitter')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Instagram</p>
        <input type="text" name="instagram" value='{{$ed ? $profile->instagram:old('instagram')}}'>
        @error('instagram')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Birth date</p>
        <input type="date" name="birthdate" value='{{$ed ? $profile->birthdate:old('birthdate')}}'>
        @error('birthdate')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Job title</p>
        <input type="text" name="occupation" value='{{$ed ? $profile->occupation:old('occupation')}}'>
        @error('occupation')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Company</p>
        <input type="text" name="company" value='{{$ed ? $profile->company:old('company')}}'>
        @error('company')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>about</p>
        <textarea name="about" cols="100" rows="3">{{$ed ? $profile->about:old('about')}}</textarea>
        @error('about')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>gender</p>
        <select type="text" name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
        </select>
        @error('gender')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <p>Phone</p>
        <input type="tel" name="phone" value='{{$ed ? $profile->phone:old('phone')}}'>
        @error('phone')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>
    <div>
        <button type="submit" class="btn">Submit</button>
    </div>
</form>