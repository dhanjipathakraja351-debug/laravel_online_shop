<ul class="list-group">

    <li class="list-group-item">
        <a href="{{ route('profile') }}">
            <i class="fas fa-user me-2"></i> My Profile
        </a>
    </li>

    <li class="list-group-item">
        <a href="{{ route('orders') }}">
            <i class="fas fa-shopping-bag me-2"></i> My Orders
        </a>
    </li>

    <li class="list-group-item">
        <a href="{{ route('wishlist.index') }}">
            <i class="fas fa-heart me-2 text-danger"></i> Wishlist
        </a>
    </li>

    <li class="list-group-item">
        <a href="{{ route('front.cart') }}">
            <i class="fas fa-shopping-cart me-2"></i> My Cart
        </a>
    </li>

    <li class="list-group-item">
    <a href="{{ route('password.change') }}">
        <i class="fa fa-key me-2"></i> Change Password
    </a>
</li>

    <li class="list-group-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-link p-0 text-danger">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </li>

</ul>