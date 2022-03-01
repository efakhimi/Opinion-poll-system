@extends('../layout/' . $layout)

@section('subhead')
    <title>ویرایش حساب کاربری</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">پروفایل کاربری {{ Auth::user()->name }}</h2>
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
            
        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('profile/')}}" enctype="multipart/form-data">
        @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">نام و نام خانوادگی</label>
                    <input id="crud-form-1" type="text" class="form-control w-full" placeholder="نام و نام خانوادگی" name="name" value="{{ old('name') ? old('name') : Auth::user()->name }}" {{Auth::user()->name == "root" ? "disabled" : ""}}>
                </div>
                <div>
                    <label for="crud-form-2" class="form-label">ایمیل</label>
                    <input id="crud-form-2" type="email" class="form-control w-full" placeholder="test@test.com" name="email" value="{{ old('email') ? old('email') : Auth::user()->email   }}">
                </div>
                <div>
                    <label for="crud-form-3" class="form-label">کلمه عبور</label>
                    <input id="crud-form-3" type="password" class="form-control w-full"  name="password">
                </div>
                <div>
                    <label for="input-wizard-2" class="form-label">تصویر</label>
                    <input id="input-wizard-2" type="file" class="form-control w-full" name="pic">
                </div>
                <div>
                    <select class="form-select mt-2 sm:ml-2" aria-label="Default select example" name="gender">
                        <option value="male" {{ ( Auth::user()->gender =="male" ? "selected" : "" )}}>مرد</option>
                        <option value="female" {{ ( Auth::user()->gender =="female" ? "selected" : "" )}}>زن</option>
                    </select>
                </div>
                <div class="mt-3">
                    حساب کاربری شما {{ (Auth::user()->active == 0 ? "غیر فعال" : "فعال") }} است.
                </div>
                <div class="mt-3">
                    حساب کاربری شما {{ (Auth::user()->is_admin == 0 ? "معمولی" : (Auth::user()->is_admin == 1 ? "مدیر" : "پشتیبان")) }} است.
                </div>
                
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1" onclick="window.location.href='{{url('/')}}';">لغو</button>
                    <button type="submit" class="btn btn-primary w-24">اعمال</button>
                </div>
            </div>
        </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

