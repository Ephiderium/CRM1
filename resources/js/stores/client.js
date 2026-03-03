  import { defineStore } from "pinia";
  import { clientAPI } from "../shared/api/client";

  export const useClientStore = defineStore("client", {
      state: () => {
          return {
              isLoading: false,
              error: null,
              client: null,
              clients: [],
          };
      },

      actions: {
          async allClients() {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.allClients();
                  this.clients = response.data.data,
                  console.log("Успешный запрос");
              } catch (err) {
                  console.error("Ошибка запроса", err);
                  this.error = err.response?.data?.message || "Ошибка запроса";
              } finally {
                  this.isLoading = false;
              }
          },
          async createClient(data) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.createClient(data);
                  console.log("Успешное создание клиента");
              } catch (err) {
                  console.error("Ошибка создания клиента: ", err);
                  this.error = err.response?.data?.message || "Ошибка создания клиента";
              } finally {
                  this.isLoading = false;
              }
          },
          async byIdClient(id) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.byIdClient(id);
                  this.client = response.data.data;
                  console.log("Успешный поиск клиента по id");
              } catch (err) {
                  console.error("Ошибка поиска клиента по id: ", err);
                  this.error = err.response?.data?.message || "Ошибка поиска клиента по id";
              } finally {
                  this.isLoading = false;
              }
          },
          async byEmailClient(data) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.byEmailClient(data);
                  this.client = response.data.data;
                  console.log("Успешный поиск клиента");
              } catch (err) {
                  console.error("Ошибка поиска клиента: ", err);
                  this.error = err.response?.data?.message || "Ошибка поиска клиента";
              } finally {
                  this.isLoading = false;
              }
          },
          async updateClient(id, data) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.updateClient(id, data);
                  this.client = response.data.data;
                  console.log("Успешное обновление клиента");
              } catch (err) {
                  console.error("Ошибка обновления клиента: ", err);
                  this.error = err.response?.data?.message || "Ошибка обновления клиента";
              } finally {
                  this.isLoading = false;
              }
          },
          async deleteClient(id) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.deleteClient(id);
                  console.log("Успешное удаление клиента");
              } catch (err) {
                  console.error("Ошибка удаления клиента: ", err);
                  this.error = err.response?.data?.message || "Ошибка удаления клиента";
              } finally {
                  this.isLoading = false;
              }
          },
          async fDeleteClient(id) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.fDeleteClient(id);
                  console.log("Успешное полное удления клиента");
              } catch (err) {
                  console.error("Ошибка полного удаления клиента: ", err);
                  this.error = err.response?.data?.message || "Ошибка полного удаления клиента";
              } finally {
                  this.isLoading = false;
              }
          },
          async changeManager(clientId, managerId) {
              this.isLoading = false;
              this.error = null;

              try {
                  this.isLoading = true;
                  const response = await clientAPI.changeManager(clientId, managerId);
                  this.client = response.data.data;
                  console.log("Успешное обновление менеджера");
              } catch (err) {
                  console.error("Ошибка обновления менеджера: ", err);
                  this.error = err.response?.data?.message || "Ошибка обновления менеджера";
              } finally {
                  this.isLoading = false;
              }
          },
      },
  });
