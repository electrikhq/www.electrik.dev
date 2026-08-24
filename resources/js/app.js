import './bootstrap';
import Alpine from 'alpinejs';
import { registerDocsSearch } from './docs-search';
import { registerNewsletter } from './newsletter';

import.meta.glob(['../images/**']);

window.Alpine = Alpine;

registerDocsSearch(Alpine);
registerNewsletter(Alpine);

Alpine.start();
