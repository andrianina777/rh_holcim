// inclu fiche css
require('../css/app.scss');
//inclu mon fiche js
require('./mon.js');
// inclu jquery
const $ = require('jquery');
global.$ = global.jQuery = $;
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');