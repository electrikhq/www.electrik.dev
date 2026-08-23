import MiniSearch from 'minisearch';

const INDEX_URL = '/search-index.json';

export function registerDocsSearch(Alpine) {
    Alpine.data('docsSearch', () => ({
        open: false,
        query: '',
        results: [],
        activeIndex: 0,
        ready: false,
        loading: false,
        error: null,
        miniSearch: null,
        documentsById: {},

        init() {
            this.bindHotkeys();
        },

        bindHotkeys() {
            window.addEventListener('keydown', (event) => {
                const metaK = (event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k';

                if (metaK) {
                    event.preventDefault();
                    this.toggle();
                    return;
                }

                if (! this.open) {
                    return;
                }

                if (event.key === 'Escape') {
                    event.preventDefault();
                    this.close();
                    return;
                }

                if (event.key === 'ArrowDown') {
                    event.preventDefault();
                    this.move(1);
                    return;
                }

                if (event.key === 'ArrowUp') {
                    event.preventDefault();
                    this.move(-1);
                    return;
                }

                if (event.key === 'Enter') {
                    event.preventDefault();
                    this.go(this.results[this.activeIndex]);
                }
            });
        },

        async ensureIndex() {
            if (this.ready || this.loading) {
                return;
            }

            this.loading = true;
            this.error = null;

            try {
                const response = await fetch(INDEX_URL, { credentials: 'same-origin' });

                if (! response.ok) {
                    throw new Error(`Search index missing (${response.status})`);
                }

                const payload = await response.json();
                const documents = Array.isArray(payload.documents) ? payload.documents : [];

                this.documentsById = Object.fromEntries(documents.map((doc) => [doc.id, doc]));

                this.miniSearch = new MiniSearch({
                    fields: ['title', 'description', 'body', 'section'],
                    storeFields: ['title', 'description', 'section', 'url'],
                    searchOptions: {
                        boost: { title: 4, description: 2, section: 1.5, body: 1 },
                        fuzzy: 0.15,
                        prefix: true,
                    },
                });

                this.miniSearch.addAll(documents);
                this.ready = true;
            } catch (error) {
                console.error(error);
                this.error = 'Search is unavailable right now.';
            } finally {
                this.loading = false;
            }
        },

        async toggle() {
            if (this.open) {
                this.close();
                return;
            }

            await this.openSearch();
        },

        async openSearch() {
            this.open = true;
            await this.ensureIndex();
            this.$nextTick(() => {
                this.$refs.searchInput?.focus();
                this.$refs.searchInput?.select?.();
            });
        },

        close() {
            this.open = false;
            this.query = '';
            this.results = [];
            this.activeIndex = 0;
        },

        onQueryInput() {
            this.search();
        },

        search() {
            const q = this.query.trim();

            if (! q || ! this.miniSearch) {
                this.results = [];
                this.activeIndex = 0;
                return;
            }

            this.results = this.miniSearch.search(q).slice(0, 12);
            this.activeIndex = 0;
        },

        move(delta) {
            if (! this.results.length) {
                return;
            }

            const next = this.activeIndex + delta;
            this.activeIndex = (next + this.results.length) % this.results.length;
        },

        go(result) {
            if (! result?.url) {
                return;
            }

            window.location.href = result.url;
        },

        groupedResults() {
            const groups = {};

            for (const result of this.results) {
                const section = result.section || 'Docs';
                if (! groups[section]) {
                    groups[section] = [];
                }
                groups[section].push(result);
            }

            return Object.entries(groups).map(([section, items]) => ({ section, items }));
        },

        resultIndex(result) {
            return this.results.findIndex((item) => item.id === result.id);
        },

        isMac() {
            return /Mac|iPhone|iPad|iPod/.test(navigator.platform || navigator.userAgent || '');
        },
    }));
}
