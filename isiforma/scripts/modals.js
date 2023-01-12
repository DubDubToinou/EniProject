
let modals = document.querySelectorAll(".isi-modal");
let buttons = document.querySelectorAll(".modal-btn");
let spans = document.querySelectorAll(".closeModal");

for (const button of buttons) {
    let buttonId = button.id.split('-').pop();

    for (const modal of modals) {
        let modalId = modal.id.split('-').pop();
        if (buttonId === modalId) {
            button.onclick = () => {
                modal.style.display = "block";
            }

            for (const span of spans) {
                let spandId = span.id.split('-').pop();
                if (modalId === spandId) {
                    span.onclick = () => {
                        modal.style.display = "none";
                    }
                }
            }

        }
    }
}
