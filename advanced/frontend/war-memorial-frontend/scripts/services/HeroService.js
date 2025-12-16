export default class HeroService {
    async getHeroes() {
        return {
            items: [
                { id: 1, name: 'Hero 1', title: 'Commander', rank: 'General', description: 'Description 1', photo: '' },
                { id: 2, name: 'Hero 2', title: 'Soldier', rank: 'Private', description: 'Description 2', photo: '' }
            ]
        };
    }

    async getHeroById(id) {
        return { id: id, name: 'Hero ' + id, title: 'Commander', rank: 'General', description: 'Detailed description for hero ' + id, photo: '' };
    }
}
