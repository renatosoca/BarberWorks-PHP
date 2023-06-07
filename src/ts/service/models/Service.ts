import { IServices } from "../../interfaces";

export class Service {
  id: string;
  title: string;
  price: number;

  constructor({ id = '', title = '', price = 0 }: IServices) {
    this.id = id;
    this.title = title;
    this.price = price;
  }
}