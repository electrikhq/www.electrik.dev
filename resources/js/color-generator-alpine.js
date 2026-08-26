import {
    PRESETS,
    bestForeground,
    contrastRatio,
    formatCssVariables,
    formatSlateTokens,
    formatTailwindV3Config,
    formatTailwindV4Theme,
    generatePalette,
    wcagLabel,
} from './tailwind-color-generator';

export function registerTailwindColorGenerator(Alpine) {
    Alpine.data('tailwindColorGenerator', () => ({
        baseHex: '#0f766e',
        scheme: 'analogous',
        shadeCount: 11,
        saturation: 72,
        colorName: 'brand',
        exportFormat: 'v4',
        copied: false,
        presetFilter: 'All',
        families: [],
        presets: PRESETS,
        schemes: [
            { id: 'monochromatic', label: 'Monochromatic' },
            { id: 'analogous', label: 'Analogous' },
            { id: 'complementary', label: 'Complementary' },
            { id: 'triadic', label: 'Triadic' },
            { id: 'tetradic', label: 'Tetradic' },
            { id: 'split-complementary', label: 'Split complementary' },
        ],
        categories: ['All', 'Modern', 'Nature', 'Professional', 'Vibrant', 'Pastel', 'Dark', 'Warm', 'Cool'],

        init() {
            this.regenerate();
            this.$watch('baseHex', () => this.regenerate());
            this.$watch('scheme', () => this.regenerate());
            this.$watch('shadeCount', () => this.regenerate());
            this.$watch('saturation', () => this.regenerate());
            this.$watch('colorName', () => this.regenerate());
        },

        get filteredPresets() {
            if (this.presetFilter === 'All') {
                return this.presets;
            }
            return this.presets.filter((p) => p.category === this.presetFilter);
        },

        get exportCode() {
            if (this.exportFormat === 'v3') {
                return formatTailwindV3Config(this.families);
            }
            if (this.exportFormat === 'css') {
                return formatCssVariables(this.families);
            }
            if (this.exportFormat === 'slate') {
                return formatSlateTokens(this.families);
            }
            return formatTailwindV4Theme(this.families);
        },

        get primaryMid() {
            const family = this.families[0];
            if (! family) {
                return this.baseHex;
            }
            return family.shades[500] || family.shades[400] || Object.values(family.shades)[0];
        },

        get primaryFg() {
            return bestForeground(this.primaryMid);
        },

        get contrastWhite() {
            return contrastRatio(this.primaryMid, '#ffffff');
        },

        get contrastBlack() {
            return contrastRatio(this.primaryMid, '#0a0a0a');
        },

        regenerate() {
            let hex = this.baseHex.trim();
            if (! hex.startsWith('#')) {
                hex = `#${hex}`;
            }
            if (!/^#[0-9a-fA-F]{6}$/.test(hex)) {
                return;
            }
            this.baseHex = hex.toLowerCase();
            this.families = generatePalette({
                baseHex: this.baseHex,
                scheme: this.scheme,
                shadeCount: Number(this.shadeCount),
                saturation: Number(this.saturation),
                colorName: this.colorName,
            });
        },

        applyPreset(preset) {
            this.baseHex = preset.hex;
            this.scheme = preset.scheme;
            this.colorName = preset.id.replace(/-/g, '');
            this.regenerate();
        },

        async copyExport() {
            try {
                await navigator.clipboard.writeText(this.exportCode);
                this.copied = true;
                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch {
                this.copied = false;
            }
        },

        shadeEntries(family) {
            return Object.entries(family.shades);
        },

        fgFor(hex) {
            return bestForeground(hex);
        },

        wcag(hex, against = '#ffffff') {
            return wcagLabel(contrastRatio(hex, against));
        },

        ratioText(value) {
            return `${value.toFixed(2)}:1`;
        },
    }));
}
