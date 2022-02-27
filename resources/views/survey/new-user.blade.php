@extends('../layout/' . $layout)

@section('subhead')
    <title>کاربر جدید</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">ایجاد کاربر جدید</h2>
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
            
        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('new-user')}}">
        @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">نام و نام خانوادگی</label>
                    <input id="crud-form-1" type="text" class="form-control w-full" placeholder="نام و نام خانوادگی" name="name" :value="{{ old('name') }}">
                </div>
                <div>
                    <label for="crud-form-1" class="form-label">ایمیل</label>
                    <input id="crud-form-1" type="email" class="form-control w-full" placeholder="test@test.com" name="email" :value="{{ old('email') }}">
                </div>
                <div>
                    <label for="crud-form-1" class="form-label">کلمه عبور</label>
                    <input id="crud-form-1" type="password" class="form-control w-full"  name="password" :value="{{ old('password') }}">
                </div>
                <div>
                    <select class="form-select mt-2 sm:ml-2" aria-label="Default select example" name="gender">
                        <option value="male">مرد</option>
                        <option value="female">زن</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>فعال باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="active">
                    </div>
                </div>
                <div class="mt-3">
                    <label>مدیر باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="isAdmin">
                    </div>
                </div>
                <div class="mt-3">
                    <label>کاربر پشتیبانی باشد؟</label>
                    <div class="form-switch mt-2">
                        <input type="checkbox" class="form-check-input" name="isSupporter">
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">لغو</button>
                    <button type="submit" class="btn btn-primary w-24">ایجاد</button>
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
