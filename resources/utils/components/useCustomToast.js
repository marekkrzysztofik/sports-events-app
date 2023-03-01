import { useToast } from "primevue/usetoast";
export function useCustomToast() {
    const toast = useToast();
    function siemaFromToast() {
        toast.add({
            severity: "info",
            summary: "Confirmed",
            detail: "Record deleted",
            life: 3000,
        });
    }
    return {siemaFromToast}
}
