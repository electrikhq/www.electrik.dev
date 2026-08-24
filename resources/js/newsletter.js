export function registerNewsletter(Alpine) {
    Alpine.data('electrikNewsletter', (config = {}) => ({
        email: '',
        status: 'idle',
        message: '',
        action: config.action || '',
        user: config.user || '',
        list: config.list || '',

        async submit() {
            const email = String(this.email || '').trim();

            if (! email) {
                this.status = 'error';
                this.message = 'Enter an email address.';
                return;
            }

            if (! this.action || ! this.user || ! this.list) {
                this.status = 'error';
                this.message = 'Newsletter is not configured.';
                return;
            }

            this.status = 'loading';
            this.message = '';

            try {
                const data = await this.postJson(email);

                if (data.result === 'success') {
                    this.status = 'success';
                    this.message =
                        this.stripHtml(data.msg) ||
                        'Check your inbox to confirm your subscription.';
                    return;
                }

                this.status = 'error';
                this.message =
                    this.stripHtml(data.msg) ||
                    'Something went wrong. Try again in a moment.';
            } catch {
                this.status = 'error';
                this.message = 'Could not reach Mailchimp. Try again.';
            }
        },

        postJson(email) {
            return new Promise((resolve, reject) => {
                const callback = `mc_${Date.now()}_${Math.floor(Math.random() * 1e6)}`;
                const params = new URLSearchParams({
                    u: this.user,
                    id: this.list,
                    EMAIL: email,
                    c: callback,
                });

                const script = document.createElement('script');
                const cleanup = () => {
                    script.remove();
                    try {
                        delete window[callback];
                    } catch {
                        window[callback] = undefined;
                    }
                };

                window[callback] = (data) => {
                    cleanup();
                    resolve(data || {});
                };

                script.src = `${this.action}?${params.toString()}`;
                script.onerror = () => {
                    cleanup();
                    reject(new Error('jsonp failed'));
                };

                document.body.appendChild(script);
            });
        },

        stripHtml(value) {
            if (! value) {
                return '';
            }

            const el = document.createElement('div');
            el.innerHTML = String(value);
            return (el.textContent || el.innerText || '').trim();
        },
    }));
}
