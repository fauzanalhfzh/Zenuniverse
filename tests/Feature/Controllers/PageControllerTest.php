<?php

test('contact page loads', function () {
    $this->get('/contact')->assertOk();
});

test('learning path page loads', function () {
    $this->get('/learning-path')->assertOk();
});
