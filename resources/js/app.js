import './bootstrap';
import Alpine from 'alpinejs';
import { registerDocsSearch } from './docs-search';
import { registerNewsletter } from './newsletter';
import { registerTailwindColorGenerator } from './color-generator-alpine';

import.meta.glob(['../images/**']);

window.Alpine = Alpine;

registerDocsSearch(Alpine);
registerNewsletter(Alpine);
registerTailwindColorGenerator(Alpine);

Alpine.start();
