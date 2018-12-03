import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.By;
import org.openqa.selenium.NoSuchElementException; 

public class WebTests {
	private static final String PATH = "C:/Users/acies/eclipse/chromedriver.exe"; 
	private static final String SITE = "https://classdb.it.mtu.edu/cs3141/wads/"; 
	private static WebDriver webDriver;
    
	/**
     * @param args
     * @throws InterruptedException
     */
	public static void main(final String[] args) throws InterruptedException {
        System.setProperty("webdriver.chrome.driver", PATH);
        webDriver = new ChromeDriver();
        webDriver.manage().window().maximize();
        
        //tests that the redirect functionality works properly
        if ( testRedirect() )
        	System.out.println("Test Redirect: Passed");
        else
        	System.out.println("Test Redirect: Failed");
        
        //tests that the admin user can login 
        if ( testAdmin() ) 
        	System.out.println("Test Admin: Passed");
        else
        	System.out.println("Test Admin: Failed");
        
        //tests for logging in with a valid username and password
        if ( testLogin( "john@smith.com", "john" ) ) 
            System.out.println("Test Successful Login: Passed");
        else 
            System.out.println("Test Successful Login: Failed");
        
        //tests for logging in with an invalid username and password 
        if ( !testLogin( "john@smith.com", "smith" ) )
        	System.out.println("Test Failed Login: Passed");
        else
        	System.out.println("Test Failed Login: Failed");
        
        //tests for creating an account successfully 
        if ( testCreateAccount( false ) )
        	System.out.println("Test Create Account: Passed");
        else
        	System.out.println("Test Create Account: Failed");
        
        //tests for creating an account successfully from the login page
        if ( testCreateAccount( true ) )
        	System.out.println("Test Create Account Login: Passed");
        else
        	System.out.println("Test Create Account Login: Failed"); 

        //tests the team name, wins, losses, and ties are displayed properly for a user
        if ( testProfile( "The LongJohns", 2, 1, 0 ) ) 
        	System.out.println("Test Profile: Passed");
        else
        	System.out.println("Test Profile: Failed");
        
        //tests the roster is displayed properly for a user
        if ( testProfileRoster() )
        	System.out.println( "Test Profile Roster: Passed" );
        else
        	System.out.println( "Test Profile Roster: Failed" );
        
        //tests that a player can be added to a team
        if ( testDraftPlayer( false ) )
        	System.out.println( "Test Draft Player: Passed" );
        else
        	System.out.println( "Test Draft Player: Failed" );
        
        //tests that a player can be added and removed
        if ( testDraftPlayer( true ) )
        	System.out.println( "Test Remove Player: Passed" );
        else
        	System.out.println( "Test Remove Player: Failed" );
        
        //tests that a goalie can be added to a team
        if ( testDraftGoalie( false ) )
        	System.out.println( "Test Draft Goalie: Passed" );
        else
        	System.out.println( "Test Draft Goalie: Failed" );
        
        //tests that a goalie can be added and removed 
        if ( testDraftGoalie( true ) ) 
        	System.out.println( "Test Remove Goalie: Passed" );
        else
        	System.out.println( "Test Remove Goalie: Failed" );
        
        //tests if the correct first team name is displayed properly
        if ( testGameRank( "The LongJohns", 20 ) ) 
        	System.out.println( "Test Game Rank: Passed" );
        else
        	System.out.println( "Test Game Rank: Failed" );
       
        //tests if the most recent game data is displayed
        if ( testGameHistory( "2018-11-04", "The Scissors" ) ) 
        	System.out.println( "Test Game History Date: Passed" );
        else
        	System.out.println( "Test Game History Date: Failed" );
        
        //tests the first team's stats are displayed correctly
        if ( testResultLeft() )
        	System.out.println( "Test Result Left: Passed" );
        else
        	System.out.println( "Test Result Right: Failed" );
        
        //tests the second team's stats are displayed correctly 
        if ( testResultRight() )
        	System.out.println( "Test Result Right: Passed" );
        else
        	System.out.println( "Test Result Right: Failed" );
        
        //tests that simulate game and match maker is called
        if ( testSimGame() )
        	System.out.println("Test Sim Game: Passed");
        else
        	System.out.println("Test Sim Game: Failed");
        
        //tests that starting the draft works properly
        if ( testStartDraft() )
        	System.out.println("Test Start Draft: Passed");
        else
        	System.out.println("Test Start Draft: Failed");
        
        webDriver.close();
        webDriver.quit();
    }

    private static boolean testLogin( String user, String pass ) {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys(user); 
            webDriver.findElement(By.name("password")).sendKeys(pass);
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.getCurrentUrl().equals(SITE+"code/profile.php")){
                return true;
            } else {
                return false;
            }
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
    private static boolean testAdmin() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("admin@admin.com"); 
            webDriver.findElement(By.name("password")).sendKeys("admin");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.getCurrentUrl().equals(SITE+"code/admin.php")){
                return true;
            } else {
                return false;
            }
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
    private static boolean testRedirect() {
        try {
            webDriver.navigate().to(SITE+"code/profile.php");
            Thread.sleep(5);
            
            if (webDriver.getCurrentUrl().equals(SITE+"code/index.html")){
                return true;
            } else {
                return false;
            }
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
    private static boolean testCreateAccount( boolean login ) {
        try {
            webDriver.navigate().to(SITE);
            if ( login ) {
                webDriver.findElement(By.name("loginLink")).click();
                webDriver.findElement(By.name("createAccountB")).click();
                webDriver.findElement(By.name("name")).sendKeys("Bob"); 
                webDriver.findElement(By.name("username")).sendKeys("bob@smith.com");
                webDriver.findElement(By.name("password")).sendKeys("smith");
                webDriver.findElement(By.name("teamName")).sendKeys("Bob the Builders");
            }
            else {
            	 webDriver.findElement(By.name("createAccountLink")).click();
                 webDriver.findElement(By.name("name")).sendKeys("Joe"); 
                 webDriver.findElement(By.name("username")).sendKeys("joe@bob.com");
                 webDriver.findElement(By.name("password")).sendKeys("bob");
                 webDriver.findElement(By.name("teamName")).sendKeys("Bobs Builders");
            }

            webDriver.findElement(By.name("createAccount")).click();
            Thread.sleep(500);

            if (webDriver.getCurrentUrl().equals(SITE+"code/profile.php")){
                return true;
            } else {
                return false;
            }
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }	 
    
    private static boolean testProfile( String name, int wins, int losses, int ties ) {
    	boolean result = false;
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("teamName")).getText().trim().equals(name)) {  
                result = true;
            } 
            if (webDriver.findElement(By.name("wins")).getText().trim().equals(wins)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("losses")).getText().trim().equals(losses)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("ties")).getText().trim().equals(ties)) {
            	result = true; 
            }
            return result; 
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return result;
        }
    }
    
    private static boolean testProfileRoster() {
    	boolean result = false;
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("p1")).getText().trim().equals("Adolfo Cowles")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("p2")).getText().trim().equals("Adolfo Havens")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("p3")).getText().trim().equals("Amal Yeager")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("p4")).getText().trim().equals("Ammie Cornwell")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("p5")).getText().trim().equals("Anneliese Sommer")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("p6")).getText().trim().equals("Amanda Stone")) {
            	result = true; 
            }
            return result; 
        }
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return result;
        }
    }
    
    private static boolean testDraftPlayer( boolean remove ) {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("draftB")).click(); 
            webDriver.findElement(By.name("select2")).click();
            if ( remove ) {
            	webDriver.findElement(By.name("rem1")).click();
            }
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("rm1")).getText().trim().equals("Adolfo Cowles")) {  
                return true;
            } else {
                return false;
            }
        } 
        catch ( NoSuchElementException e ) {
        	return true; 
        }
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
    private static boolean testDraftGoalie( boolean remove ) {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            webDriver.navigate().to(SITE+"code/draft2.php");
            webDriver.findElement(By.name("select3")).click();
            if ( remove ) {
            	webDriver.navigate().to(SITE+"code/draft2.php");
            	webDriver.findElement(By.name("rem6")).click();
            }
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("rm6")).getText().trim().equals("Amanda Stone")) {  
                return true;
            } else {
                return false;
            }
        } 
        catch ( NoSuchElementException e ) {
        	return true; 
        }
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
    private static boolean testGameRank( String name, int score ) {
    	boolean result = false; 
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("gameB")).click();
            
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("t1")).getText().trim().equals(name)) {  
                result = true;
            } 
            if (webDriver.findElement(By.name("s1")).getText().trim().equals(score)) {
            	result = true;
            }
            return result; 
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return result;
        }
    }
    
    private static boolean testGameHistory( String date, String winner ) {
    	boolean result = false; 
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("gameB")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("date")).getText().trim().equals(date)) {  
                result = true;
            } 
            if (webDriver.findElement(By.name("win")).getText().trim().equals(winner)) {
            	result = true; 
            }
            return result; 
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return result;
        }
    }
    
    private static boolean testResultLeft(){
    	boolean result = false; 
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("gameB")).click();
            webDriver.findElement(By.name("playGame")).click(); 
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("t1")).getText().trim().equals("The Scissors")) {  
                result = true;
            } 
            if (webDriver.findElement(By.name("s1")).getText().trim().equals(3)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("pn")).getText().trim().equals("Anthony Blanco")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("go")).getText().trim().equals(0)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("as")).getText().trim().equals(0)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("pm")).getText().trim().equals(0)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("cs")).getText().trim().equals(0)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("gn")).getText().trim().equals("Chris Wilkerson")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("gm")).getText().trim().equals(150)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("ga")).getText().trim().equals(11)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("sa")).getText().trim().equals(139)) {
            	result = true; 
            }
            return result; 
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return result;
        }
    }
    
    private static boolean testResultRight(){
    	boolean result = false; 
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("gameB")).click();
            webDriver.findElement(By.name("playGame")).click(); 
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("t2")).getText().trim().equals("The LongJohns")) {  
                result = true;
            } 
            if (webDriver.findElement(By.name("s2")).getText().trim().equals(1)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("pn")).getText().trim().equals("Adolfo Cowles")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("go")).getText().trim().equals(2)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("as")).getText().trim().equals(3)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("pm")).getText().trim().equals(0)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("cs")).getText().trim().equals(0)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("gn")).getText().trim().equals("Amanda Stone")) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("gm")).getText().trim().equals(30)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("ga")).getText().trim().equals(10)) {
            	result = true; 
            }
            if (webDriver.findElement(By.name("sa")).getText().trim().equals(33)) {
            	result = true; 
            }
            return result; 
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return result;
        }
    }
    
    private static boolean testSimGame() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("admin@admin.com"); 
            webDriver.findElement(By.name("password")).sendKeys("admin");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("simGame")).click();
            Thread.sleep(500);
            
            if ( webDriver.switchTo().alert().getText().equals("Players and goalies have been assigned points, and matches have been made!") ) {
            	return true;
            }
            else {
            	return false; 
            }
            
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
    private static boolean testStartDraft() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("admin@admin.com"); 
            webDriver.findElement(By.name("password")).sendKeys("admin");
            webDriver.findElement(By.name("login")).click();
            webDriver.findElement(By.name("startDraft")).click();
            Thread.sleep(500);
            
            if ( webDriver.getCurrentUrl().equals(SITE+"/code/createDraftOrder.php") ) {
            	return true;
            }
            else {
            	return false; 
            }
            
        } 
        catch (final Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }
    
}
