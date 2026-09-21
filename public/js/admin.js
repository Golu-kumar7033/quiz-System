document.addEventListener("DOMContentLoaded", function () {
    const qtype = document.getElementById("qtype");

    const mcq = document.getElementById("mcq");
    const tf = document.getElementById("tf");
    const fill = document.getElementById("fill");

    qtype.addEventListener("change", function () {
        // Hide all sections first
        mcq.style.display = "none";
        tf.style.display = "none";
        fill.style.display = "none";

        // Show selected section
        if (this.value === "mcq") {
            mcq.style.display = "block";

        } 
        else if (this.value === "tf") {
            tf.style.display = "block";

        } 
        else if (this.value === "fill") {
            fill.style.display = "block";

        }
    });
});


