'use strict';
let mix = require('laravel-mix');

function IOFinanceiro(params = {}) {
    let $ = this;
    let dep = {
        financeiro: 'vendor/agileti/iofinanceiro/src/assets/src/',
        moment: 'node_modules/moment/'
    }

    let config = {
        optimize: false,
        sass: false,
        cb: () => { },
    }

    this.compile = (IO, callback = () => { }) => {
        mix.copyDirectory('vendor/agileti/iofinanceiro/src/assets/', 'node_modules/intranetone-financeiro/');
        mix.styles([
            IO.src.css + 'helpers/dv-buttons.css',
            IO.dep.io.toastr + 'toastr.min.css',
            IO.src.io.css + 'toastr.css',
            dep.financeiro + 'financeiro.css',
        ], IO.dest.io.root + 'services/io-financeiro.min.css');

        mix.babel([
            IO.dep.io.toastr + 'toastr.min.js',
            IO.src.io.js + 'defaults/def-toastr.js',
        ], IO.dest.io.root + 'services/io-financeiro-babel.min.js');

        mix.scripts([
            dep.moment + 'min/moment.min.js',
            IO.src.io.vendors + 'moment/moment-pt-br.js'
        ], IO.dest.io.root + 'services/io-financeiro-mix.min.js');

        //copy separated for compatibility
        mix.babel(dep.financeiro + 'financeiro.js', IO.dest.io.root + 'services/io-financeiro.min.js');

        callback(IO);
    }
}


module.exports = IOFinanceiro;
