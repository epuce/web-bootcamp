export class Sport {
    id: number;
    name: string;
    teamSport?: boolean;

    constructor($data) {
        this.id = $data['id'];
        this.name = $data['name'];
        this.teamSport = $data["teamSport"] || false
    }
}