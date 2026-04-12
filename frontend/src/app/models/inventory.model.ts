export class InventoryModel {
    constructor (
        public id: number,
        public quantity: number,
        public location: String,
        public library_id: number,
        public isbn: String,
        public created_at: Date,
        public updated_at: Date,
        public deleted_at: Date
    ){}
}
