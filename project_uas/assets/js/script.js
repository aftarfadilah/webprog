$(document).ready(function() {
    var total = 0;

    $('.add-to-cart').click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var url = $(this).data('url');
        $(this).prop("disabled",true);

        // Create the cart item HTML
        var cartItemHTML = '';
        cartItemHTML += '<li>';
        cartItemHTML += 'Nama Makanan: ' + nama + ' ';
        cartItemHTML += '(Rp' + harga.toLocaleString('id-ID') + ')';
        cartItemHTML += '</li>';

        // Append the cart item HTML to the cart items section
        $('#cart-list').append(cartItemHTML);

        // Add the harga value to the total
        total += parseInt(harga);

        // Update the total display with formatted harga
        $('#total').text('Rp' + total.toLocaleString('id-ID'));
    });
});