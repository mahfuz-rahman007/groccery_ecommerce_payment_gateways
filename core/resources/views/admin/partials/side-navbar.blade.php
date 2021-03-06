@php
$lang_code = $currentLang->code;
@endphp


<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-light-primary">
    <!-- Sidebar -->
    <div class="sidebar pt-0 mt-0">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel d-flex">
            <div class="image">
                <img src=" " class="elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> </a>
                <span>{{ __('Admin') }}</span>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item has-treeview
            @if (request()->path() == 'admin/basicinfo') menu-open
            @elseif(request()->path() == 'admin/seoinfo') menu-open
            @elseif(request()->path() == 'admin/custom-css') menu-open
            @elseif(request()->path() == 'admin/slinks') menu-open
            @elseif(request()->path() == 'admin/email-config') menu-open
            @elseif(request()->path() == 'admin/scripts') menu-open
            @elseif(request()->path() == 'admin/cookie-alert') menu-open
            @elseif(request()->path() == 'admin/page-visibility') menu-open
            @elseif(request()->is('admin/slinks/edit/*')) menu-open @endif">
                    <a href="#"
                        class="nav-link
              @if (request()->path() == 'admin/basicinfo') active
              @elseif(request()->path() == 'admin/seoinfo') active
              @elseif(request()->path() == 'admin/custom-css') active
              @elseif(request()->path() == 'admin/slinks') active
              @elseif(request()->path() == 'admin/scripts') active
              @elseif(request()->path() == 'admin/cookie-alert') active
              @elseif(request()->path() == 'admin/email-config') active
              @elseif(request()->path() == 'admin/page-visibility') active
              @elseif(request()->is('admin/slinks/edit/*')) active @endif">
                        <i class="nav-icon fas fas fa-cog"></i>
                        <p>
                            {{ __('General Setting') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.setting.basicinfo') . '?language=' . $lang_code }}"
                                class="nav-link @if (request()->path() == 'admin/basicinfo') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Basic Information') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mail.config') }}"
                                class="nav-link @if (request()->path() == 'admin/email-config') active @endif">

                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Email Configuration') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link @if (request()->path() == 'admin/slinks') active
                          @elseif(request()->is('admin/slinks/edit/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Social Links') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.seoinfo') . '?language=' . $lang_code }}"
                                class="nav-link @if (request()->path() == 'admin/seoinfo') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('SEO Information') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link @if (request()->path() == 'admin/scripts') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Scripts') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link  @if (request()->path() == 'admin/page-visibility') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pages Visibility') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link  @if (request()->path() == 'admin/cookie-alert') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Cookie Alert') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link  @if (request()->path() == 'admin/custom-css') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Custom CSS') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview
                    @if(request()->path() == 'admin/currency') menu-open
                    @elseif(request()->path() == 'admin/payment/gateways') menu-open
                    @elseif(request()->is('admin/payment/gateways/edit/*')) menu-open
                    @elseif(request()->path() == 'admin/shipping/methods') menu-open
                    @elseif(request()->path() == 'admin/shipping/method/add') menu-open
                    @elseif(request()->is('admin/shipping/method/edit/*')) menu-open
                    @elseif(request()->path() == 'admin/currency/add') menu-open
                    @elseif(request()->is('admin/currency/edit/*')) menu-open

                    @endif">
                    <a href="#" class="nav-link
                    @if(request()->path() == 'admin/currency') active
                    @elseif(request()->path() == 'admin/payment/gateways') active
                    @elseif(request()->is('admin/payment/gateways/edit/*')) active
                    @elseif(request()->path() == 'admin/shipping/methods') active
                    @elseif(request()->path() == 'admin/shipping/method/add') active
                    @elseif(request()->is('admin/shipping/method/edit/*')) active
                    @elseif(request()->path() == 'admin/currency/add') active
                    @elseif(request()->is('admin/currency/edit/*')) active


                    @endif">
                    <i class="nav-icon far fa-credit-card"></i>
                    <p>
                        {{ __('Payment Settings') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.currency') }}"
                                class="nav-link
                                @if (request()->path() == 'admin/currency') active
                                @elseif(request()->path() == 'admin/currency/add') active
                                @elseif(request()->is('admin/currency/edit/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Currency') }}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.payment.index') }}" class="nav-link
                                @if(request()->path() == 'admin/payment/gateways') active
                                @elseif(request()->is('admin/payment/gateways/edit/*')) active
                                @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Payment Gateway') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.shipping.index') }}" class="nav-link
                                @if(request()->path() == 'admin/shipping/methods') active
                                @elseif(request()->path() == 'admin/shipping/method/add') active
                                @elseif(request()->is('admin/shipping/method/edit/*')) active
                                @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Shipping Method') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview
                    @if (request()->routeIs('admin.register.user')) menu-open
                    @elseif(request()->routeIs('register.user.view')) menu-open
                    @elseif(request()->routeIs('register.user.package_buy')) menu-open
                    @elseif(request()->routeIs('register.user.package_not_buy')) menu-open @endif
                    ">
                    <a href="#"
                        class="nav-link
                        @if (request()->routeIs('admin.register.user')) active
                        @elseif(request()->routeIs('register.user.view')) active
                        @elseif(request()->routeIs('register.user.package_buy')) active
                        @elseif(request()->routeIs('register.user.package_not_buy')) active @endif
                        ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Customers') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link
                      @if (request()->routeIs('admin.register.user')) active @endif
                      ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Customers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link
                      @if (request()->routeIs('register.user.package_buy')) active @endif
                      ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Package Buy') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link
                      @if (request()->routeIs('register.user.package_not_buy')) active @endif
                      ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Package Not Buy') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item has-treeview
                  @if (request()->path() == 'admin/product') menu-open
                  @elseif(request()->path() == 'admin/product-category') menu-open
                  @elseif(request()->path() == 'admin/product-category/add')menu-open
                  @elseif(request()->path() == 'admin/product/add') menu-open
                  @elseif(request()->path() == 'admin/product/all/orders') menu-open
                  @elseif(request()->path() == 'admin/product/pending/orders') menu-open
                  @elseif(request()->path() == 'admin/product/processing/orders') menu-open
                  @elseif(request()->path() == 'admin/product/completed/orders') menu-open
                  @elseif(request()->path() == 'admin/product/rejected/orders') menu-open
                  @elseif(request()->is('admin/product-category/edit/*')) menu-open
                  @elseif(request()->is('admin/product/edit/*')) menu-open
                  @elseif(request()->is('admin/product/orders/detais/*')) menu-open @endif">
                    <a href="#"
                        class="nav-link
                      @if (request()->path() == 'admin/product') active
                      @elseif (request()->path() == 'admin/product-category') active
                      @elseif(request()->path() == 'admin/product-category/add') active
                      @elseif(request()->path() == 'admin/product/add') active
                      @elseif(request()->path() == 'admin/product/all/orders') active
                      @elseif(request()->path() == 'admin/product/pending/orders') active
                      @elseif(request()->path() == 'admin/product/processing/orders') active
                      @elseif(request()->path() == 'admin/product/completed/orders') active
                      @elseif(request()->path() == 'admin/product/rejected/orders') active
                      @elseif(request()->is('admin/product-category/edit/*')) active
                      @elseif(request()->is('admin/product/edit/*')) active
                      @elseif(request()->is('admin/product/orders/detais/*')) active @endif">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            {{ __('Product') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.pcategory') }}"
                                class="nav-link
                              @if (request()->path() == 'admin/product-category') active
                              @elseif(request()->path() == 'admin/product-category/add') active
                              @elseif(request()->is('admin/product-category/edit/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Product Category') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product') }}"
                                class="nav-link
                              @if (request()->path() == 'admin/product') active
                              @elseif(request()->path() == 'admin/product/add') active
                              @elseif(request()->is('admin/product/edit/*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Products') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.all.product.orders') }}" class="nav-link @if (request()->path() == 'admin/product/all/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Order') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pending.product.orders') }}" class="nav-link @if (request()->path() == 'admin/product/pending/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Order') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.processing.product.orders') }}"
                                class="nav-link
                          @if (request()->path() == 'admin/product/processing/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('In Progress Order') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.completed.product.orders') }}"
                                class="nav-link
                          @if (request()->path() == 'admin/product/completed/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Completed Order') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rejected.product.orders') }}"
                                class="nav-link
                      @if (request()->path() == 'admin/product/rejected/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Rejected Order') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item has-treeview
                      @if (request()->path() == 'admin/bill-pay') menu-open
                      @elseif(request()->path() == 'admin/add') menu-open
                      @elseif(request()->path() == 'admin/bill-add') menu-open @endif
                      ">
                    <a href="#"
                        class="nav-link
                      @if (request()->path() == 'admin/bill-pay') active
                      @elseif(request()->path() == 'admin/add') active
                      @elseif(request()->path() == 'admin/bill-add') active @endif">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            {{ __('Bill Pay') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link @if (request()->path() == 'admin/bill-pay') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Bill Pay') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link
                              @if (request()->path() == 'admin/add') active
                              @elseif(request()->path() == 'admin/bill-add') active @endif
                                  ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add New Bill') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.slider') }}"
                        class="nav-link
                      @if (request()->path() == 'admin/slider') active
                      @elseif(request()->path() == 'admin/slider/add') active
                      @elseif(request()->is('admin/slider/edit/*')) active @endif">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            {{ __('Slider') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.about') . '?language=' . $lang_code }}"
                        class="nav-link
                      @if (request()->path() == 'admin/about') active
                      @elseif(request()->path() == 'admin/about/add') active
                      @elseif(request()->is('admin/about/edit/*')) active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ __('About') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link
                      @if (request()->path() == 'admin/funfact') active
                      @elseif(request()->path() == 'admin/funfact/add') active
                      @elseif(request()->is('admin/funfact/edit/*')) active @endif">
                        <i class="nav-icon fas fa-smile-beam"></i>
                        <p>
                            {{ __('Funfact') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link
                  @if (request()->path() == 'admin/testimonial') active
                  @elseif(request()->path() == 'admin/testimonial/add') active
                  @elseif(request()->is('admin/testimonial/edit/*')) active @endif">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            {{ __('Testimonial') }}
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('admin.footer.index') . '?language=' . $lang_code }}"
                        class="nav-link @if (request()->path() == 'admin/footer') active @endif">
                        <i class="nav-icon fas fa-feather-alt"></i>
                        <p>
                            {{ __('Footer') }}
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('admin.language.index') }}"
                        class="nav-link
                      @if (request()->path() == 'admin/languages') active
                      @elseif(request()->path() == 'admin/language/add') active
                      @elseif(request()->is('admin/language/edit/*')) active
                      @elseif(request()->is('admin/language/edit/keyword/*')) active @endif">
                        <i class="nav-icon fas fa-language"></i>
                        <p>
                            {{ __('Language') }}
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
