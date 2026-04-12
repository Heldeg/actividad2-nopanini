export class CategoryModel {
    constructor(
        public category_id: number,
        public name: String,
        public parent_category_id: number,
        public created_at: Date,
        public updated_at: Date,
        public deleted_at: Date
    ){}
}
