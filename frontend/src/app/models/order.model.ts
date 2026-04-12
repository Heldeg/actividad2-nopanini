export class OrderModel {
    constructor (
        public id: number,
        public name: String,
        public address: String,
        public tel_number: String,
        public created_at: Date,
        public updated_at: Date,
        public deleted_at: Date
    ){}
}
