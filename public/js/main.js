$(function () {
  'use strict';

  $('#modalSignin').on('submit', function (event) {
    console.log('Signin Form Submitted');
    $('#modalSignin').modal('hide');
  });
});