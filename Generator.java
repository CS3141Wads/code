package lifetimePlayerGenerator;

import java.util.Random;

public class Generator {

	public static void main(String arg[]) {
		Generator g = new Generator();
		String[] a = g.gen(100);
		for(int i = 0; i < a.length - 1; i++) {
			System.out.println(a[i]);
		}
	}

	public String[] gen(int num) {
		String[] array = new String[101]; 
		int goals = 0;
		int assists = 0;
		int points = 0;
		int penlty = 0;
		String[] names = { "Colby Gresham", "Marcelino Bond", "Chris Leighton", "Janay Bunch", "Isobel Styles",
				"Sammy Horowitz", "Voncile Gaston", "Starr Loera", "Garland Sanborn", "Sulema Spangler", "Nilda Cheek",
				"Kanesha Finney", "Elton Swenson", "Teodoro Montanez", "Dolly Fennell", "Britt Villalobos",
				"Brittni Spearman", "Vickey Mccray", "Dante Ocampo", "Kenda Conley", "Kerstin Havens", "Zack Rodrigue",
				"Gearldine Tuggle", "Thresa Olsen", "Myrna Shade", "Candida Ingle", "Vina Halcomb", "Tosha Mixon",
				"Wilmer Rounds", "Lita Wilder", "Barbra Upchurch", "Carma Griggs", "Laurinda Blevins",
				"Jeanene Dasilva", "Augustina Millard", "Kristofer Crittenden", "Keitha Kimbrough", "Tyree Lehmann",
				"Lenore Mcneal", "Christin Lacy", "Anneliese Sommer", "Dayna Pomeroy", "Cherelle Nobles", "Treasa Deal",
				"Shizuko Evers", "Leonia Grover", "Tam Tillman", "Karisa Hewitt", "Tomeka Whitmire", "Noriko Ely",
				"Inga Winchester", "Ka Brothers", "Carli Augustine", "Cristobal Cathey", "Chauncey Terrell",
				"Leta Cardwell", "Magaly Hildreth", "Sasha Hare", "Gussie Mueller", "Jeri Carman", "Alphonso Fraley",
				"Ashlyn Bogan", "Tennie Taggart", "Una Minter", "Danuta Damon", "Colette Mackay", "Brett Pippin",
				"Catarina Montero", "Lakeshia Troutman", "Martine Vu", "Normand Leblanc", "Esmeralda Fontaine",
				"Raylene Cline", "Elisha Hawks", "Albertine Spain", "Abigail Cady", "Nedra Whitfield", "Ayanna Pride",
				"Fredric Cave", "Rochell Creamer", "An Kincaid", "Trinity Buss", "Julieta Baines", "Melina Custer",
				"Eladia Ferrari", "Lily Peacock", "Zula Hackney", "Jadwiga Matheson", "Lesia Ochoa", "Anthony Blanco",
				"Carolyne Darnell", "Katy Council", "Amal Yeager", "Soledad Linn", "Lavon Brenner", "Kassandra Matos",
				"Lizabeth Dyson", "Romeo Mowery", "Harold Jefferies", "Lakendra Raynor" };
		String[] team = { "We want a parking garager ", "Portage Swimmers ", "Overly Cuncussed", "Slippery Ice", "Brockway Brawlers", "Hill Fallers", "Broken Roads ", "Dodge Street Dodgers", "Blue Wings", "Pasties" };
		int[] teamStat = { 7,2,1, 4,5,1, 0,10,0, 6,4,0, 5,4,1, 4,5,1, 9,1,0, 10,0,0, 1,8,1, 6,4,0};
		for (int i = 0; i < num; i++) {
			goals = 0;
			assists = 0;
			points = 0;
			penlty = 0;
			Random rand = new Random(i);
			int g = rand.nextInt(5);
			int a = rand.nextInt(5);
			int p1 = rand.nextInt(2);
			int p2 = rand.nextInt(2);
			int p3 = rand.nextInt(15);
			if (p1 < 1) {
				goals = g;
			}
			if (p2 < 1) {
				assists = a;
			}
			if (p3 < 4 ) {
				penlty = 2;
			}
			if (p3 < 2) {
				penlty = 5;
			}
			if (p3 < 1 ) {
				penlty = 4;
			}
			if(i%10 == 0) {
				goals = rand.nextInt(10);
				assists = rand.nextInt(10);
			}
			points = goals * 2 + assists;

			array[i] = String.format("insert into playerLifetime values('%s', '%s', %d, %d, %d, %d, %d, %d, %d);", names[i],
					team[i%team.length], teamStat[(3 * i) % (teamStat.length)], teamStat[(3 * i + 1) % (teamStat.length)],
					teamStat[(3 * i + 2) % (teamStat.length)], goals, assists, points, penlty);
			if(i >= 99) {
				break;
			}
		}
		return array;
	}
}
