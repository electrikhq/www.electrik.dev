/**
 * Color math + palette generation for the Tailwind color generator tool.
 */

const SHADE_STEPS_11 = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950];
const SHADE_STEPS_9 = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900];
const SHADE_STEPS_5 = [100, 300, 500, 700, 900];

const LIGHTNESS_11 = [0.97, 0.93, 0.86, 0.76, 0.66, 0.55, 0.45, 0.36, 0.27, 0.18, 0.12];
const LIGHTNESS_9 = [0.97, 0.93, 0.86, 0.76, 0.66, 0.55, 0.45, 0.36, 0.27];
const LIGHTNESS_5 = [0.93, 0.76, 0.55, 0.36, 0.18];

export function clamp(n, min, max) {
    return Math.min(max, Math.max(min, n));
}

export function hexToRgb(hex) {
    const raw = String(hex || '').replace('#', '').trim();
    const full = raw.length === 3
        ? raw.split('').map((c) => c + c).join('')
        : raw;

    if (!/^[0-9a-fA-F]{6}$/.test(full)) {
        return { r: 15, g: 118, b: 110 }; // teal fallback
    }

    return {
        r: parseInt(full.slice(0, 2), 16),
        g: parseInt(full.slice(2, 4), 16),
        b: parseInt(full.slice(4, 6), 16),
    };
}

export function rgbToHex(r, g, b) {
    const to = (n) => clamp(Math.round(n), 0, 255).toString(16).padStart(2, '0');
    return `#${to(r)}${to(g)}${to(b)}`;
}

export function rgbToHsl(r, g, b) {
    r /= 255;
    g /= 255;
    b /= 255;
    const max = Math.max(r, g, b);
    const min = Math.min(r, g, b);
    const l = (max + min) / 2;
    let h = 0;
    let s = 0;

    if (max !== min) {
        const d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch (max) {
            case r:
                h = ((g - b) / d + (g < b ? 6 : 0)) / 6;
                break;
            case g:
                h = ((b - r) / d + 2) / 6;
                break;
            default:
                h = ((r - g) / d + 4) / 6;
        }
    }

    return { h: h * 360, s: s * 100, l: l * 100 };
}

function hue2rgb(p, q, t) {
    let T = t;
    if (T < 0) T += 1;
    if (T > 1) T -= 1;
    if (T < 1 / 6) return p + (q - p) * 6 * T;
    if (T < 1 / 2) return q;
    if (T < 2 / 3) return p + (q - p) * (2 / 3 - T) * 6;
    return p;
}

export function hslToRgb(h, s, l) {
    const H = ((h % 360) + 360) % 360 / 360;
    const S = clamp(s, 0, 100) / 100;
    const L = clamp(l, 0, 100) / 100;

    if (S === 0) {
        const v = L * 255;
        return { r: v, g: v, b: v };
    }

    const q = L < 0.5 ? L * (1 + S) : L + S - L * S;
    const p = 2 * L - q;

    return {
        r: hue2rgb(p, q, H + 1 / 3) * 255,
        g: hue2rgb(p, q, H) * 255,
        b: hue2rgb(p, q, H - 1 / 3) * 255,
    };
}

export function hslToHex(h, s, l) {
    const { r, g, b } = hslToRgb(h, s, l);
    return rgbToHex(r, g, b);
}

export function relativeLuminance(hex) {
    const { r, g, b } = hexToRgb(hex);
    const lin = [r, g, b].map((c) => {
        const s = c / 255;
        return s <= 0.03928 ? s / 12.92 : ((s + 0.055) / 1.055) ** 2.4;
    });
    return 0.2126 * lin[0] + 0.7152 * lin[1] + 0.0722 * lin[2];
}

export function contrastRatio(hexA, hexB) {
    const L1 = relativeLuminance(hexA);
    const L2 = relativeLuminance(hexB);
    const lighter = Math.max(L1, L2);
    const darker = Math.min(L1, L2);
    return (lighter + 0.05) / (darker + 0.05);
}

export function bestForeground(bgHex) {
    const white = contrastRatio(bgHex, '#ffffff');
    const black = contrastRatio(bgHex, '#0a0a0a');
    return white >= black ? '#ffffff' : '#0a0a0a';
}

export function wcagLabel(ratio) {
    if (ratio >= 7) return 'AAA';
    if (ratio >= 4.5) return 'AA';
    if (ratio >= 3) return 'AA large';
    return 'Fail';
}

function shadeSteps(count) {
    if (count <= 5) return { steps: SHADE_STEPS_5, lights: LIGHTNESS_5 };
    if (count <= 9) return { steps: SHADE_STEPS_9, lights: LIGHTNESS_9 };
    return { steps: SHADE_STEPS_11, lights: LIGHTNESS_11 };
}

export function buildShadeScale(hex, shadeCount = 11, saturationBoost = 0) {
    const { h, s } = rgbToHsl(...Object.values(hexToRgb(hex)));
    const { steps, lights } = shadeSteps(shadeCount);
    const sat = clamp(s + saturationBoost, 0, 100);
    const scale = {};

    steps.forEach((step, i) => {
        const light = lights[i] * 100;
        // Keep mid tones more saturated; wash extremes slightly.
        const stepSat = step <= 100 || step >= 900 ? sat * 0.55 : sat;
        scale[step] = hslToHex(h, stepSat, light);
    });

    return scale;
}

export function harmonyHues(baseHue, scheme) {
    const h = ((baseHue % 360) + 360) % 360;

    switch (scheme) {
        case 'analogous':
            return [h, (h + 30) % 360, (h + 330) % 360];
        case 'complementary':
            return [h, (h + 180) % 360];
        case 'triadic':
            return [h, (h + 120) % 360, (h + 240) % 360];
        case 'tetradic':
            return [h, (h + 90) % 360, (h + 180) % 360, (h + 270) % 360];
        case 'split-complementary':
            return [h, (h + 150) % 360, (h + 210) % 360];
        case 'monochromatic':
        default:
            return [h];
    }
}

const ROLE_NAMES = ['primary', 'secondary', 'accent', 'tertiary'];

export function generatePalette({
    baseHex,
    scheme = 'monochromatic',
    shadeCount = 11,
    saturation = 80,
    colorName = 'brand',
}) {
    const rgb = hexToRgb(baseHex);
    const { h, s } = rgbToHsl(rgb.r, rgb.g, rgb.b);
    const satBoost = saturation - s;
    const hues = harmonyHues(h, scheme);
    const families = [];

    hues.forEach((hue, index) => {
        const name = hues.length === 1
            ? slugify(colorName || 'brand')
            : (index === 0 ? slugify(colorName || 'primary') : ROLE_NAMES[index] || `color${index + 1}`);
        const seed = hslToHex(hue, clamp(saturation, 0, 100), 50);
        families.push({
            name,
            hue: Math.round(hue),
            seed,
            shades: buildShadeScale(seed, shadeCount, satBoost * 0.15),
        });
    });

    // Neutrals from base hue at low saturation for cohesive UI kits.
    families.push({
        name: 'neutral',
        hue: Math.round(h),
        seed: hslToHex(h, 8, 50),
        shades: buildShadeScale(hslToHex(h, 8, 50), shadeCount, -40),
    });

    return families;
}

export function slugify(value) {
    return String(value || 'brand')
        .trim()
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '') || 'brand';
}

export function formatTailwindV4Theme(families) {
    const lines = ['@theme {'];
    families.forEach((family) => {
        Object.entries(family.shades).forEach(([step, hex]) => {
            lines.push(`  --color-${family.name}-${step}: ${hex};`);
        });
    });
    lines.push('}');
    return lines.join('\n');
}

export function formatTailwindV3Config(families) {
    const colors = {};
    families.forEach((family) => {
        colors[family.name] = { ...family.shades };
    });

    return `/** @type {import('tailwindcss').Config} */\nmodule.exports = {\n  theme: {\n    extend: {\n      colors: ${JSON.stringify(colors, null, 8).replace(/^/gm, '      ').trim()},\n    },\n  },\n};\n`;
}

export function formatCssVariables(families) {
    const lines = [':root {'];
    families.forEach((family) => {
        Object.entries(family.shades).forEach(([step, hex]) => {
            lines.push(`  --${family.name}-${step}: ${hex};`);
        });
    });
    lines.push('}');
    return lines.join('\n');
}

export function formatSlateTokens(families) {
    const primary = families.find((f) => f.name === 'primary' || f.name !== 'neutral') || families[0];
    const mid = primary.shades[500] || primary.shades[400] || Object.values(primary.shades)[Math.floor(Object.values(primary.shades).length / 2)];
    const lightFg = bestForeground(mid);

    return `/* Electrik Slate token overrides */\n:root {\n  --slate-primary: ${mid};\n  --slate-primary-foreground: ${lightFg};\n  --slate-ring: ${mid};\n}\n\n.dark {\n  --slate-primary: ${primary.shades[400] || mid};\n  --slate-primary-foreground: ${bestForeground(primary.shades[400] || mid)};\n  --slate-ring: ${primary.shades[400] || mid};\n}\n`;
}

export const PRESETS = [
    { id: 'teal', label: 'Teal', category: 'Professional', hex: '#0f766e', scheme: 'analogous' },
    { id: 'forest', label: 'Forest', category: 'Nature', hex: '#166534', scheme: 'monochromatic' },
    { id: 'ink', label: 'Ink', category: 'Professional', hex: '#1e293b', scheme: 'monochromatic' },
    { id: 'amber', label: 'Amber', category: 'Warm', hex: '#b45309', scheme: 'complementary' },
    { id: 'rose', label: 'Rose', category: 'Vibrant', hex: '#be123c', scheme: 'split-complementary' },
    { id: 'ocean', label: 'Ocean', category: 'Cool', hex: '#0369a1', scheme: 'analogous' },
    { id: 'plum', label: 'Plum', category: 'Pastel', hex: '#6b21a8', scheme: 'triadic' },
    { id: 'copper', label: 'Copper', category: 'Warm', hex: '#9a3412', scheme: 'analogous' },
    { id: 'mint', label: 'Mint', category: 'Nature', hex: '#0d9488', scheme: 'monochromatic' },
    { id: 'midnight', label: 'Midnight', category: 'Dark', hex: '#312e81', scheme: 'complementary' },
    { id: 'sand', label: 'Sand', category: 'Pastel', hex: '#a16207', scheme: 'monochromatic' },
    { id: 'slate-blue', label: 'Slate blue', category: 'Modern', hex: '#334155', scheme: 'analogous' },
];
