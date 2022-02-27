@extends('../layout/' . $layout)

@section('subhead')
    <title>ویرایش کاربر {{($userData['name'])}}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">ویرایش کاربر {{($userData['name'])}}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- BEGIN: Form Layout -->
            
        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('edit-user/'.$userData['id'])}}">
        @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">نام و نام خانوادگی</label>
                    <input id="crud-form-1" type="text" class="form-control w-full" placeholder="نام و نام خانوادگی" name="name" value="{{ old('name') ? old('name') : $userData['name'] }}">
                </div>
                <div>
                    <label for="crud-form-1" class="form-label">ایمیل</label>
                    <input id="crud-form-1" type="email" class="form-control w-full" placeholder="test@test.com" name="email" value="{{ old('email') ? old('email') : $userData['email']   }}">
                </div>
                <div>
                    <label for="crud-form-1" class="form-label">کلمه عبور</label>
                    <input id="crud-form-1" type="password" class="form-control w-full"  name="password">
                </div>
                <div>
                    <select class="form-select mt-2 sm:mr-2" aria-label="Default select example" name="gender">
                        <option value="male" {{ ( $userData['gender']=="male" ? "selected" : "" )}}>مرد</option>
                        <option value="female" {{ ( $userData['gender']=="female" ? "selected" : "" )}}>زن</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>فعال باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="active" {{ ( $userData['active']==1 ? "checked" : "" )}}>
                    </div>
                </div>
                <div class="mt-3">
                    <label>مدیر باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="isAdmin" {{ ( $userData['is_admin']==1 ? "checked" : "" )}}>
                    </div>
                </div>
                <div class="mt-3">
                    <label>کاربر پشتیبانی باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="isSupporter" {{ ( $userData['is_admin']==2 ? "checked" : "" )}}>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1" onclick="window.location.href='{{route('users-list.showList')}}';">لغو</button>
                    <button type="submit" class="btn btn-primary w-24">اعمال</button>
                </div>
            </div>
        </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
