import { useToast } from "primevue/usetoast";
import { useConfirm } from "primevue/useconfirm";
export function useConfirmDialog() {
    const toast = useToast();
    const confirm = useConfirm();
    function confirmDialog(id) {
        confirm.require({
            message: "Do you want to delete this record?",
            header: "Delete Confirmation",
            icon: "pi pi-info-circle",
            acceptClass: "p-button-danger",
            accept: () => {
                toast.add({
                    severity: "info",
                    summary: "Confirmed",
                    detail: "Record deleted",
                    life: 3000,
                });
                console.log(id)
            },
            reject: () => {
                toast.add({
                    severity: "error",
                    summary: "Rejected",
                    detail: "You have rejected",
                    life: 3000,
                });
            },
        });
    }
    return { confirmDialog }
}
