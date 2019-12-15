<!--     left side Menu and logo section start-->
<div class="col-sm-4 col-lg-2 col-md-3 dashboard-left-side-menu">
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-menu dbm-h">
                <nav>
                    <ul>
                        <li>
                            <a href="{{route('dashboard')}}" data-toggle="" class="icon-show-hide-one">
                                <div class="icon-margin-rigth-css"><i class="fas fa-home margin-right-css"></i></div> Dashboard
                            </a>
                        </li>
                        @if(in_array('sales', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#sales" data-toggle="collapse" class="icon-show-hide-two">
                                <div class="icon-margin-rigth-css"><i class="fab fa-sellsy margin-right-css"></i></div>
                                <div>Sales</div>
                                <i class="fas fa-angle-right menu-icon-show-two"></i>
                                <ul id="sales" class="collapse">
                                    <li><a href="{{route('sales')}}">New Sales</a></li>
                                    <li><a href="{{route('sales-manage')}}">Manage Sales</a></li>
                                    <li><a href="{{route('sales-paid')}}">Paid Sales</a></li>
                                    <li><a href="{{route('sales-unpaid')}}">Unpaid Sales</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('product', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#product" data-toggle="collapse" class="icon-show-hide-three">
                                <div class="icon-margin-rigth-css"><i class="fab fa-product-hunt margin-right-css"></i>
                                </div>
                                <div>Product</div>
                                <i class="fas fa-angle-right menu-icon-show-three"></i>
                                <ul id="product" class="collapse">
                                    <li><a href="{{route('product')}}">Add Product</a></li>
                                    <li><a href="{{route('product-manage')}}">Manage Product</a></li>
                                    <li><a href="{{route('product-category')}}">Product Categories</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="#company" data-toggle="collapse" class="icon-show-hide-three">
                                <div class="icon-margin-rigth-css"><i class="fab fa-product-hunt margin-right-css"></i>
                                </div>
                                <div>Company</div>
                                <i class="fas fa-angle-right menu-icon-show-threeas"></i>
                                <ul id="company" class="collapse">
                                    <li><a href="{{route('product-company-add')}}">Add Company</a></li>
                                    <li><a href="{{route('product-company')}}">Manage Company</a></li>
                                </ul>
                            </a>
                        </li>
                        @if(in_array('stock', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#stock" data-toggle="collapse" class="icon-show-hide-four">
                                <div class="icon-margin-rigth-css"><i class="fas fa-warehouse margin-right-css"></i></div>
                                <div> Stock</div>
                                <i class="fas fa-angle-right menu-icon-show-four"></i>
                                <ul id="stock" class="collapse">
                                    <li><a href="{{route('stock')}}">Stock</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('expired', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#expire" data-toggle="collapse" class="icon-show-hide-five">
                                <div class="icon-margin-rigth-css"><i class="fab fa-empire margin-right-css"></i></div>
                                <div>Expired</div>
                                <i class="fas fa-angle-right menu-icon-show-five"></i>
                                <ul id="expire" class="collapse">
                                    <li><a href="{{route('expire')}}">Expired</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif

                            <li>
                                <a href="#purchase" data-toggle="collapse" class="icon-show-hide-six">
                                    <div class="icon-margin-rigth-css"><i class="fas fa-adjust margin-right-css"></i></div>
                                    <div>Purchase</div>
                                    <i class="fas fa-angle-right menu-icon-show-six"></i>
                                    <ul id="purchase" class="collapse">
                                        <li><a href="{{route('product-company-add')}}">Add Company</a></li>
                                        <li><a href="{{route('purchase.index')}}">Add Purchase</a></li>
                                        <li><a href="{{route('manage-purchase')}}">Manage Purchase</a></li>
                                        <li><a href="{{route('paid-purchase')}}">Paid Purchase</a></li>
                                        <li><a href="#">Unpaid Purchase</a></li>

                                    </ul>
                                </a>
                            </li>

                        @if(in_array('expense', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#expense" data-toggle="collapse" class="icon-show-hide-six">
                                <div class="icon-margin-rigth-css"><i class="fas fa-adjust margin-right-css"></i></div>
                                <div>Expense</div>
                                <i class="fas fa-angle-right menu-icon-show-six"></i>
                                <ul id="expense" class="collapse">
                                    <li><a href="{{route('expense')}}">Add Expense Type</a></li>
                                    <li><a href="{{route('expense-manage')}}">Manage Expense Type</a></li>
                                    <li><a href="{{route('a-invoice')}}">Add Expense Invoice</a></li>
                                    <li><a href="{{route('m-invoice')}}">Manage Expense Invoice</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('order', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#order" data-toggle="collapse" class="icon-show-hide-seven">
                                <div class="icon-margin-rigth-css"><i
                                        class="fab fa-first-order-alt margin-right-css"></i></div>
                                <div>Order</div>
                                <i class="fas fa-angle-right menu-icon-show-seven"></i>
                                <ul id="order" class="collapse">
                                    <li><a href="">New Sales</a></li>
                                    <li><a href="">Manage Sales</a></li>
                                    <li><a href="">Paid Sales</a></li>
                                    <li><a href="">Unpaid Sales</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('branch', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#branch" data-toggle="collapse" class="icon-show-hide-eight">
                                <div class="icon-margin-rigth-css"><i class="fas fa-code-branch margin-right-css"></i>
                                </div>
                                <div>Branch</div>
                                <i class="fas fa-angle-right menu-icon-show-eight"></i>
                                <ul id="branch" class="collapse">
                                    <li><a href="">New Sales</a></li>
                                    <li><a href="">Manage Sales</a></li>
                                    <li><a href="">Paid Sales</a></li>
                                    <li><a href="">Unpaid Sales</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('stuff', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#stuff" data-toggle="collapse" class="icon-show-hide-nine">
                                <div class="icon-margin-rigth-css"><i class="fas fa-users margin-right-css"></i></div>
                                <div>Staff</div>
                                <i class="fas fa-angle-right menu-icon-show-nine"></i>
                                <ul id="stuff" class="collapse">
                                    <li><a href="{{route('staff')}}">Add Staff</a></li>
                                    <li><a href="{{route('staff-manage')}}">Manage Staff</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#customer" data-toggle="collapse" class="icon-show-hide-ten">
                                <div class="icon-margin-rigth-css"><i class="fab fa-intercom margin-right-css"></i>
                                </div>
                                <div>Customer</div>
                                <i class="fas fa-angle-right menu-icon-show-ten"></i>
                                <ul id="customer" class="collapse">
                                    <li><a href="{{route('customer')}}">Add Customer</a></li>
                                    <li><a href="{{route('customer-manage')}}">Manage Customers</a></li>
                                    <li><a href="{{route('customer-credit')}}">Credit Customers</a></li>
                                    <li><a href="{{route('customer-paid')}}">Paid Customer</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('loan', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#loan" data-toggle="collapse" class="icon-show-hide-eleven">
                                <div class="icon-margin-rigth-css"><i class="fas fa-luggage-cart margin-right-css"></i>
                                </div>
                                <div>Loan</div>
                                <i class="fas fa-angle-right menu-icon-show-eleven"></i>
                                <ul id="loan" class="collapse">
                                    <li><a href="{{route('loaner')}}">Manage Loaners</a></li>
                                    <li><a href="{{route('loan')}}">Add Loan</a></li>
                                    <li><a href="{{route('loan-manage')}}">Manage Loan</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('report', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#report" data-toggle="collapse" class="icon-show-hide-thirten">
                                <div class="icon-margin-rigth-css"><i class="fas fa-bug margin-right-css"></i></div>
                                <div>Report</div>
                                <i class="fas fa-angle-right menu-icon-show-thirten"></i>
                                <ul id="report" class="collapse">
                                    <li><a href="{{route('ledger')}}">Sales Profit/Loss Ledger</a></li>
                                    <li><a href="{{route('sales-ledger')}}">Sales Ledger</a></li>
                                    <li><a href="{{route('expense-ledger')}}">Expences Ledger</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                        @if(in_array('setting', explode(",", Session::get('loggedUser')['role']  )))
                        <li>
                            <a href="#setting" data-toggle="collapse" class="icon-show-hide-fourten">
                                <div class="icon-margin-rigth-css"><i class="fas fa-cog margin-right-css"></i></div>
                                <div>Setting</div>
                                <i class="fas fa-angle-right menu-icon-show-fourten"></i>
                                <ul id="setting" class="collapse">
                                    <li><a href="{{route('info')}}">Company Info</a></li>
                                    <li><a href="{{route('payment_info')}}">Payment Info</a></li>
                                    <li><a href="{{route('logout')}}">Signout</a></li>
                                </ul>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-2 col-md-2 col-lg-1 dashboard-left-side-menu-icon-one">
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-menu text-center">
                <div class="btn-group dropright">
                    <a href="{{route('dashboard')}}">
                        <button type="button" class="btn btn-secondary" data-toggle="" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="fas fa-home"></i>
                        </button>
                    </a>
                </div>
                @if(in_array('sales', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Sales">
                        <i class="fab fa-sellsy"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('sales')}}" class="dropdown-item">New Sales</a>
                        <a href="{{route('sales-manage')}}" class="dropdown-item">Manage Sales</a>
                        <a href="{{route('sales-paid')}}" class="dropdown-item">Paid Sales</a>
                        <a href="{{route('sales-unpaid')}}" class="dropdown-item">Unpaid Sales</a>
                    </div>
                </div>
                @endif
                @if(in_array('product', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Product">
                        <i class="fab fa-product-hunt"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('product')}}" class="dropdown-item">Add Product</a>
                        <a href="{{route('product-manage')}}" class="dropdown-item">Manage Product</a>
                        <a href="{{route('product-category')}}" class="dropdown-item">Product Categories</a>
                    </div>
                </div>
                @endif
                @if(in_array('stock', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Stock">
                        <i class="fas fa-warehouse"></i>
                    </button>
                    <div class="dropdown-menu">

                        <a href="{{route('stock')}}" class="dropdown-item">Stock</a>
                    </div>
                </div>
                @endif
                @if(in_array('expired', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Expire">
                        <i class="fab fa-empire"></i>
                        <div class="dropdown-menu">
                            <a href="{{route('expire')}}" class="dropdown-item">Expired</a>
                        </div>
                </div>
                @endif
                @if(in_array('expense', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Expense">
                        <i class="fas fa-adjust"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('expense')}}" class="dropdown-item">Add Expense Type</a>
                        <a href="{{route('expense-manage')}}" class="dropdown-item">Manage Expenses Type</a>
                        <a href="{{route('a-invoice')}}" class="dropdown-item">Add Expenses Invoice</a>
                        <a href="{{route('m-invoice')}}" class="dropdown-item">Manage Expense Invoice</a>
                    </div>
                </div>
                @endif
                @if(in_array('order', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Order">
                        <i class="fab fa-first-order-alt"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="" class="dropdown-item">New Sales</a>
                        <a href="" class="dropdown-item">Manage Sales</a>
                        <a href="" class="dropdown-item">Paid Sales</a>
                        <a href="" class="dropdown-item">Unpaid Sales</a>
                    </div>
                </div>
                @endif
                @if(in_array('branch', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Branch">
                        <i class="fas fa-code-branch"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="" class="dropdown-item">New Sales</a>
                        <a href="" class="dropdown-item">Manage Sales</a>
                        <a href="" class="dropdown-item">Paid Sales</a>
                        <a href="" class="dropdown-item">Unpaid Sales</a>
                    </div>
                </div>
                @endif
                @if(in_array('stuff', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Staff">
                        <i class="fas fa-users"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('staff')}}" class="dropdown-item">Add Stuff</a>
                        <a href="{{route('staff-manage')}}" class="dropdown-item">Manage Staff</a>
                    </div>
                </div>
                @endif
                @if(in_array('customer', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Customer">
                        <i class="fab fa-intercom"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('customer')}}" class="dropdown-item">Add Customer</a>
                        <a href="{{route('customer-manage')}}" class="dropdown-item">Manage Customers</a>
                        <a href="{{route('customer-credit')}}" class="dropdown-item">Credit Customers</a>
                        <a href="{{route('customer-paid')}}" class="dropdown-item">Paid Customer</a>
                    </div>
                </div>
                @endif
                @if(in_array('loan', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Loan">
                        <i class="fas fa-luggage-cart"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('loaner')}}" class="dropdown-item">Manage Loaners</a>
                        <a href="{{route('loan')}}" class="dropdown-item">Add Loan</a>
                        <a href="{{route('loan-manage')}}" class="dropdown-item">Manage Loan</a>
                    </div>
                </div>
                @endif
                @if(in_array('report', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Report">
                        <i class="fas fa-bug"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('ledger')}}" class="dropdown-item">Sales Profit/Loss Ledger</a>
                        <a href="{{route('sales-ledger')}}" class="dropdown-item">Sales Ledger</a>
                        <a href="{{route('expense-ledger')}}" class="dropdown-item">Expences Ledger</a>
                    </div>
                </div>
                @endif
                @if(in_array('setting', explode(",", Session::get('loggedUser')['role']  )))
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="Setting">
                        <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('info')}}" class="dropdown-item">Company Info</a>
                        <a href="{{route('payment_info')}}" class="dropdown-item">Payment Info</a>
                        <a href="{{route('logout')}}" class="dropdown-item">Signout</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
