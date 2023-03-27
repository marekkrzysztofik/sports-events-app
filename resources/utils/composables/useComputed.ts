import { Ref, computed } from "vue";

export function useComputed(data: Ref<Array<any>>) {
    const count = computed(() => {
        if (data.value) {
            return data.value.length;
        } else {
            return 0;
        }
    });
    return {
        count,
    };
}
