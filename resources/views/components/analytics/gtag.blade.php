@props([
    'id' => null,
])

@php
    $measurementId = $id ?: config('services.google_analytics.measurement_id');
@endphp

@if(filled($measurementId))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $measurementId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json($measurementId));

        /**
         * Ecommerce helpers (GA4). Purchase must never fire from an unauthenticated thanks page.
         * Server Measurement Protocol is source of truth; client purchase uses the same
         * transaction_id (payment_id) so GA4 de-dupes within ~72h.
         */
        window.electrikAnalytics = {
            beginCheckout(tier, value, currency) {
                if (typeof gtag !== 'function') return;
                gtag('event', 'begin_checkout', {
                    currency: currency || 'USD',
                    value: Number(value) || 0,
                    items: [{
                        item_id: tier,
                        item_name: tier === 'studio' ? 'Electrik Studio' : 'Electrik Solo',
                        item_category: 'commercial_license',
                        item_variant: tier,
                        price: Number(value) || 0,
                        quantity: 1,
                    }],
                });
            },
            purchaseFromLedger(payload) {
                if (typeof gtag !== 'function' || !payload || !payload.payment_id) return false;
                const key = 'ga_purchase_' + payload.payment_id;
                try {
                    if (window.localStorage.getItem(key) === '1') return false;
                } catch (e) {}
                const value = payload.amount != null
                    ? Number(payload.amount) / 100
                    : (payload.tier === 'studio' ? 149 : 99);
                gtag('event', 'purchase', {
                    transaction_id: payload.payment_id,
                    currency: (payload.currency || 'USD').toUpperCase(),
                    value: value,
                    items: [{
                        item_id: payload.product_id || payload.tier,
                        item_name: payload.tier === 'studio' ? 'Electrik Studio' : 'Electrik Solo',
                        item_category: 'commercial_license',
                        item_variant: payload.tier || 'unknown',
                        price: value,
                        quantity: 1,
                    }],
                });
                try {
                    window.localStorage.setItem(key, '1');
                } catch (e) {}
                return true;
            },
        };
    </script>
@endif
