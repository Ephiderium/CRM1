import { defineStore } from "pinia";
import { authAPI } from "../shared/api/auth";

export const useAuthStore = defineStore("counter", {
    state: () => {
        return {
            isLoading: false,
            error: null,
        };
    },

    actions: {
        async login(credentials) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await authAPI.login(credentials);
                localStorage.setItem("token", response.data.token);
                console.log("Успешный вход: ", response.data);
            } catch (err) {
                console.error("Ошибка входа: ", err);
                this.error = err.response?.data?.message || "Ошибка входа";
            } finally {
                this.isLoading = false;
            }
        },

        async logout() {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await authAPI.logout();
                console.log("Успешный выход");
            } catch (err) {
                console.error("Ошибка выхода: ", response.data);
                this.error = err.response?.data?.message || "Ошибка выхода";
            } finally {
                this.isLoading = false;
            }
        }
    },
});
