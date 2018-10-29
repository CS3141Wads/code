package lifetimePlayerGenerator;

import static org.junit.Assert.assertEquals;
import static org.junit.jupiter.api.Assertions.*;

import org.junit.jupiter.api.Test;

class GeneratorTest {

	Generator gen = new Generator();

	@Test
	void test1() {
		String[] last = gen.gen(10);
		int size = 0;
		while (last[size] != null) {
			size++;
		}
		assertEquals(10, size);
	}

	@Test
	void test2() {
		String[] last = gen.gen(200);
		int size = 0;
		while (last[size] != null) {
			size++;
		}
		assertEquals(100, size);
	}
	
	@Test
	void test3() {
		String[] last = gen.gen(1);
		String r = "insert into playerLifetime values('Colby Gresham', 'We want a parking garager ', 7, 2, 1, 3, 1, 7, 0);";
		assertEquals(r, last[0]);
	}
	
	@Test
	void test4() {
		String[] last = gen.gen(120);
		String r = "insert into playerLifetime values('Lakendra Raynor', 'Pasties', 6, 4, 0, 2, 0, 4, 4);";
		assertEquals(r, last[99]);
	}
	
	
}
