<div class="user-info">
    <img class="mb-3 show-img img-demo" src="
    @if(Auth::user()->photo)
    {{ asset('assets/front/img/'.Auth::user()->photo) }}
    @else
    {{ asset('assets/admin/img/img-demo.jpg') }}
    @endif"
    alt="">
    <h4>{{ Auth::user()->name }}</h4>
</div>
<div class="user-menu">
<ul>
  <li>
    <a class="link @if(request()->path() == 'user/dashboard') active  @endif" href="{{ route('user.dashboard') }}"> {{ __('Dashboard') }} </a>
  </li>
  <li>
    <a class="link
    @if(request()->path() == 'user/product-orders') active
    @elseif(request()->is('user/product-order/*')) active
    @endif"
    href="{{ route('user.dashboard') }}"> {{ __('Product Order') }} </a>
  </li>
  <li>
    <a class="link @if(request()->path() == 'user/bill-pay') active  @endif" href="{{ route('user.dashboard') }}"> {{ __('Bill Pay') }} </a>
  </li>
  <li>
    <a class=" link @if(request()->path() == 'user/edit-profile') active  @endif" href="{{ route('user.editprofile') }}"> {{ __('Edite Profile') }} </a>
  </li>
  <li>
    <a class="link @if(request()->path() == 'user/change-password') active  @endif" href="{{ route('user.change_password') }}"> {{ __('Change Password') }} </a>
  </li>
  <li>
    <a class="link" href="{{ route('user.logout') }}"> {{ __('Logout') }} </a>
  </li>
</ul>
</div>

