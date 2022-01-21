import * as url from "url";

require('./bootstrap');

import Swal from 'sweetalert2';
window.Swal = Swal;

window.$ = window.jQuery = require('jquery');
window.dt = require('datatables.net');

import 'particles.js/particles';
const particlesJS = window.particlesJS;

// JSON file is located in the directory of 'public/js/particlejs-config.json'
particlesJS.load('particles-js', "js/particlesjs-config.json" , function() {
    console.log('callback - particles.js config loaded');
});