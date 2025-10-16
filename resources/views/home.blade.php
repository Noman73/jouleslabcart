<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop - Cart System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">ShopHub</h1>
        <button id="cartBtn" class="relative p-2 text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span id="cartCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
        </button>
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Featured Products</h2>

    <!-- Products Grid -->
    <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                        <button onclick="addToCart({{ $product->id }})" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

<!-- Cart Sidebar -->
<div id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50">
    <div class="h-full flex flex-col">
        <!-- Cart Header -->
        <div class="p-6 border-b">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Shopping Cart</h2>
                <button id="closeCart" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Cart Items -->
        <div id="cartItems" class="flex-1 overflow-y-auto p-6">
            <!-- Cart items will be inserted here -->
        </div>

        <!-- Cart Footer -->
        <div class="border-t p-6 bg-gray-50">
            <!-- Coupon Section -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Have a coupon?</label>
                <div class="flex gap-2">
                    <input type="text" id="couponInput" placeholder="Enter coupon code" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button id="applyCoupon" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition-colors">Apply</button>
                </div>
                <div id="couponMessage" class="mt-2 text-sm"></div>
            </div>

            <!-- Price Breakdown -->
            <div class="space-y-2 mb-4">
                <div class="flex items-center justify-between text-gray-600">
                    <span>Subtotal:</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div id="discountRow" class="flex items-center justify-between text-green-600 hidden">
                    <span>Discount (<span id="discountCode"></span>):</span>
                    <span id="discountAmount">-$0.00</span>
                </div>
                <div class="flex items-center justify-between text-lg font-semibold text-gray-900 pt-2 border-t">
                    <span>Total:</span>
                    <span id="cartTotal">$0.00</span>
                </div>
            </div>

            <button id="checkoutBtn" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Checkout
            </button>
        </div>
    </div>
</div>

<!-- Cart Overlay -->
<div id="cartOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

<script>
    // Cart data
    let cart = [];
    let appliedCoupon = null;

    // Available coupons (for client-side description only)
    const coupons = @json($coupons);
    let coupon_discount=0;
    let couponStatus=false;
    // DOM elements
    const cartBtn = document.getElementById('cartBtn');
    const closeCart = document.getElementById('closeCart');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartOverlay = document.getElementById('cartOverlay');
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const couponInput = document.getElementById('couponInput');
    const applyCouponBtn = document.getElementById('applyCoupon');
    const couponMessage = document.getElementById('couponMessage');
    const subtotal = document.getElementById('subtotal');
    const discountRow = document.getElementById('discountRow');
    const discountCode = document.getElementById('discountCode');
    const discountAmount = document.getElementById('discountAmount');

    // Fetch headers with CSRF
    function getHeaders() {
        return {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        };
    }

    // Fetch cart from server
    async function fetchCart() {
        try {
            const res = await fetch('{{route("api.cart")}}');
            if (!res.ok) throw new Error('Failed to fetch cart');
            const data = await res.json();
            cart = data.cart;
            console.log(data);
            console.log(data,'get cart');
            appliedCoupon = data.applied_coupon;
            coupon_discount=data.discount_amount
            console.log(coupon_discount)
            couponStatus=true;
            updateCart();
        } catch (error) {
            console.error('Error fetching cart:', error);
        }
    }

    // Add to cart
    async function addToCart(productId) {
        try {
            const res = await fetch('{{route('api.add.cart')}}', {
                method: 'POST',
                headers: getHeaders(),
                body: JSON.stringify({ product_id: productId })
            });
            console.log(res,'res');
            if (!res.ok) throw new Error('Failed to add to cart');
            const data = await res.json();
            cart = data.cart;
            console.log(data,'data');
            appliedCoupon = data.applied_coupon;
            couponStatus = true;
            coupon_discount=data.discount_amount;
            updateCart();
            showNotification('Added to cart!');
        } catch (error) {
            console.log('Error adding to cart:', error);
            showNotification('Failed to add to cart', 'error');
        }
    }

    // Update quantity
    async function updateQuantity(productId, change) {
        try {
            const res = await fetch('{{route("api.update.cart")}}', {
                method: 'POST',
                headers: getHeaders(),
                body: JSON.stringify({ product_id: productId, change: change })
            });
            if (!res.ok) throw new Error('Failed to update quantity');
            const data = await res.json();
            cart = data.cart;
            appliedCoupon = data.applied_coupon;
            updateCart();
        } catch (error) {
            console.error('Error updating quantity:', error);
        }
    }

    // Remove from cart
    async function removeFromCart(productId) {
        try {
            const res = await fetch('{{route("api.remove.cart")}}', {
                method: 'POST',
                headers: getHeaders(),
                body: JSON.stringify({ product_id: productId })
            });
            if (!res.ok) throw new Error('Failed to remove from cart');
            const data = await res.json();
            cart = data.cart;
            appliedCoupon = data.applied_coupon;
            updateCart();
        } catch (error) {
            console.error('Error removing from cart:', error);
        }
    }

    // Clear cart
    async function clearCart() {
        try {
            const res = await fetch('/cart/clear', {
                method: 'POST',
                headers: getHeaders()
            });
            if (!res.ok) throw new Error('Failed to clear cart');
            const data = await res.json();
            cart = data.cart;
            appliedCoupon = data.applied_coupon;
            updateCart();
        } catch (error) {
            console.error('Error clearing cart:', error);
        }
    }

    // Apply coupon
    async function handleApplyCoupon() {
        const code = couponInput.value.trim().toUpperCase();

        if (!code) {
            showCouponMessage('Please enter a coupon code', 'error');
            return;
        }

        if (cart.length === 0) {
            showCouponMessage('Add items to cart first', 'error');
            return;
        }

        try {
            const res = await fetch('{{route("api.cart.apply_coupons")}}', {
                method: 'POST',
                headers: getHeaders(),
                body: JSON.stringify({ code: code })
            });
            if (!res.ok) {
                appliedCoupon = null;
                coupon_discount=0;
                updateCart();
                const data = await res.json();
                console.log(data,'res');
                let err=data.errors.code[0];
                showCouponMessage(err, 'error');
                throw new Error(err);
            }
            const data = await res.json();
            cart = data.cart;
            appliedCoupon = data.applied_coupon;
            coupon_discount=data.discount_amount;
            updateCart();
            showCouponMessage(`Coupon applied!`, 'success');
        } catch (error) {
            console.log(error);
            // showCouponMessage(error, 'error');
        }
    }

    // Update cart display
    function updateCart() {
        // Update cart count
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;

        // Update cart items
        if (cart.length === 0) {
            cartItems.innerHTML = '<p class="text-gray-500 text-center">Your cart is empty</p>';
        } else {
            cartItems.innerHTML = cart.map(item => `
                    <div class="flex items-center gap-4 mb-4 pb-4 border-b">
                        <img src="${item.image}" alt="${item.name}" class="w-20 h-20 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">${item.name}</h4>
                            <p class="text-gray-600">${parseFloat(item.price).toFixed(2)}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <button onclick="updateQuantity(${item.id}, -1)" class="w-8 h-8 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                <span class="w-8 text-center font-semibold">${item.quantity}</span>
                                <button onclick="updateQuantity(${item.id}, 1)" class="w-8 h-8 bg-gray-200 rounded hover:bg-gray-300">+</button>
                            </div>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                `).join('');
        }

        // Calculate subtotal
        const subtotalAmount = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        subtotal.textContent = `$${subtotalAmount.toFixed(2)}`;

        // Calculate discount
        let discount = 0;
        if (appliedCoupon) {
            // const couponData = coupons[appliedCoupon];
            // if (couponData.type === 'percentage') {
            //     discount = subtotalAmount * (couponData.value / 100);
            // } else {
            //     discount = Math.min(couponData.value, subtotalAmount);
            // }
            discount=coupon_discount;
            discountRow.classList.remove('hidden');
            discountCode.textContent = appliedCoupon;
            discountAmount.textContent = `-$${discount.toFixed(2)}`;
        } else {
            discountRow.classList.add('hidden');
        }

        // Calculate total
        const total = subtotalAmount - discount;
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }

    // Show coupon message
    function showCouponMessage(message, type) {
        couponMessage.textContent = message;
        couponMessage.className = `mt-2 text-sm ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
        setTimeout(() => {
            couponMessage.textContent = '';
        }, 3000);
    }

    // Toggle cart
    function toggleCart() {
        cartSidebar.classList.toggle('translate-x-full');
        cartOverlay.classList.toggle('hidden');
    }

    // Show notification
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 2000);
    }

    // Event listeners
    cartBtn.addEventListener('click', toggleCart);
    closeCart.addEventListener('click', toggleCart);
    cartOverlay.addEventListener('click', toggleCart);
    applyCouponBtn.addEventListener('click', handleApplyCoupon);
    checkoutBtn.addEventListener('click', () => {
        if (cart.length > 0) {
            alert('Thank you for your order! Total: ' + cartTotal.textContent);
            clearCart();
            toggleCart();
        }
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        fetchCart();
    });

</script>
</body>
</html>
