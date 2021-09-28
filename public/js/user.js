
$('#add-role').click(function(){
    // Je récupère le numéro des futurs champs que je vais créer
    const index = $('widgets-counter').val();

    // Je récupère le prototype des entrées
    const tmpl = $('#user_RolesUser').data('prototype').replace(/_name_/g, index);

    // J'injecte ce code au sein de la div
    $('#user_RolesUser').append(tmpl);

    $('#widgets-counter').val(index + 1);

    // Je gère le bouton supprimer
    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    })
}

function updateCounter() {
    const count = +$('#user_RolesUser div.form-group').length;

    $('widgets-counter').val(count);
}

updateCounter();
handleDeleteButtons();