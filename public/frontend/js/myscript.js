// $(".Trialcategories div div a").click(function() {
//     var serviceid = $(this).attr("data-id");
//     $("#servicesModal .modal-dialog .modal-content ul").empty();
//     // alert(serviceid);
//     $("#servicesModal").modal('show');


//     $("#servicesModal .modal-dialog .modal-content .modal-body .bg-image").css({ "backgroundImage": "url('../images/depressed-young-spanish-male-sitting-chair-leaning-his-head-against-wall-2.png') " })
//     $("#servicesModal .modal-dialog .modal-content .p1").html(`Anxiety is a primary emotion that helps individuals survive certain things or dangerous situations. One may even exhibit anxiousness or nervousness when they have to tackle everyday situations like problems at the workplace, walking in an interview, taking tests, or making crucial decisions. One may also experience physical signs of anxiety, such as palpitations and sweating. 
//     Anxiety is generally considered a disorder requiring treatment when it arises without any threat or disproportionate relation to a threat. It keeps the affected individual from leading an everyday life.
//     An interaction of biopsychosocial factors can cause anxiety disorders. Genetic vulnerability interacting with stressful or traumatic situations produces clinically significant syndromes.
    
//     `);
//     $("#servicesModal .modal-dialog .modal-content .p2").html("The following conditions can cause anxiety:");
//     $("#servicesModal .modal-dialog .modal-content .p3").html("Anxiety disorders can make it difficult for one to get through the day. It can, however, be treated effectively.");
//     $("#servicesModal .modal-dialog .modal-content h3").html("Anxiety Disorder");
//     var allList = '<li>Medications</li>';
//     allList += "<li>Medications</li>";
//     allList += "<li>Childhood experiences</li>";
//     allList += "<li>Substance abuse</li>";
//     allList += "<li>Trauma</li>";
//     allList += "<li>Panic disorders</li>";
//     $("#servicesModal .modal-dialog .modal-content ul").append(allList);

// })
$(function() {
    $("#tabs").tabs();

});