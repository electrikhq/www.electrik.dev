export function registerNewsletter(Alpine) {
    Alpine.data('electrikNewsletter', (config = {}) => ({
        email: '',
        honeypot: '',
        status: 'idle',
        message: '',
        action: config.action || '',

        async submit() {
            const email = String(this.email || '').trim();

            if (! email) {
                this.status = 'error';
                this.message = 'Enter an email address.';
                return;
            }

            if (! this.action) {
                this.status = 'error';
                this.message = 'Newsletter is not configured.';
                return;
            }

            this.status = 'loading';
            this.message = '';

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const res = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        email,
                        company_website: this.honeypot,
                    }),
                });

                const data = await res.json().catch(() => ({}));

                if (res.ok && data.ok) {
                    this.status = 'success';
                    this.message = data.message || 'You are on the list.';
                    return;
                }

                this.status = 'error';
                this.message =
                    data.message ||
                    data.errors?.email?.[0] ||
                    'Something went wrong. Try again in a moment.';
            } catch {
                this.status = 'error';
                this.message = 'Could not reach the newsletter service. Try again.';
            }
        },
    }));
}
