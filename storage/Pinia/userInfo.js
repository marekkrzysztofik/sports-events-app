import { defineStore } from "pinia";

export const useUserInfo = defineStore("userInfo", {
    state: () => {
        return {
            id: 0,
            type: "",
        };
    },
    persist: {
        enabled: true,
    },
});
