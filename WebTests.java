import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.By; 

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

        //tests for logging in with a valid username and password
        if (testSuccessfulLogin()) 
            System.out.println("Test Successful Login: Passed");
        else 
            System.out.println("Test Successful Login: Failed");
        
        //tests for logging in with an invalid username and password 
        if (testFailedLogin())
        	System.out.println("Test Failed Login: Passed");
        else
        	System.out.println("Test Failed Login: Failed");
        
        //tests for creating an account successfully 
        if (testCreateAccount())
        	System.out.println("Test Create Account: Passed");
        else
        	System.out.println("Test Create Account: Failed");
        
        //tests for creating an account successfully from the login page
        if (testCreateAccountLogin())
        	System.out.println("Test Create Account Login: Passed");
        else
        	System.out.println("Test Create Account Login: Failed");
        
        //tests the team name is displayed properly for a user
        if ( testProfileTeamName() ) 
        	System.out.println("Test Profile Team Name: Passed");
        else
        	System.out.println("Test Profile Team Name: Failed");
        
        //tests the wins are displayed properly for a user
        if ( testProfileWins() )
        	System.out.println("Test Profile Wins: Passed");
        else
        	System.out.println("Test Profile Wins: Failed");
        
        //tests the losses are displayed properly for a user
        if ( testProfileLosses() )
        	System.out.println("Test Profile Losses: Passed");
        else
        	System.out.println("Test Profile Losses: Failed");
        	
        //tests the ties are displayed properly for a user
        if ( testProfileTies() )
        	System.out.println("Test Profile Ties: Passed");
        else
        	System.out.println("Test Profile Ties: Failed");
        
        webDriver.close();
        webDriver.quit();
    }

    private static boolean testSuccessfulLogin() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
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
    
    private static boolean testFailedLogin() {
        try {
            webDriver.navigate().to(SITE);
            webDriver.findElement(By.name("loginLink")).click(); 
            webDriver.findElement(By.name("username")).sendKeys("johns@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);

            if (webDriver.getCurrentUrl().equals(SITE+"code/login.php")){
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
    
    private static boolean testCreateAccountLogin() {
        try {
            webDriver.navigate().to(SITE);
            webDriver.findElement(By.name("loginLink")).click();
            webDriver.findElement(By.name("createAccountB")).click(); 
            webDriver.findElement(By.name("name")).sendKeys("Bob"); 
            webDriver.findElement(By.name("username")).sendKeys("bob@smith.com");
            webDriver.findElement(By.name("password")).sendKeys("bob");
            webDriver.findElement(By.name("teamName")).sendKeys("Bob the Builders");
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
    
    
    private static boolean testCreateAccount() {
        try {
            webDriver.navigate().to(SITE);
            webDriver.findElement(By.name("createAccountLink")).click();
            webDriver.findElement(By.name("name")).sendKeys("Joe"); 
            webDriver.findElement(By.name("username")).sendKeys("joe@smith.com");
            webDriver.findElement(By.name("password")).sendKeys("joe");
            webDriver.findElement(By.name("teamName")).sendKeys("Jelly Joes");
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
    
    private static boolean testProfileTeamName() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("teamName")).getText().trim().equals("The LongJohns")) {  
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
    
    private static boolean testProfileWins() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("wins")).getText().trim().equals("0 wins")) {  
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
    
    private static boolean testProfileLosses() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("losses")).getText().trim().equals("0 losses")) {  
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
    
    private static boolean testProfileTies() {
        try {
            webDriver.navigate().to(SITE+"code/login.php");
            webDriver.findElement(By.name("username")).sendKeys("john@smith.com"); 
            webDriver.findElement(By.name("password")).sendKeys("john");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.findElement(By.name("ties")).getText().trim().equals("0 ties")) {  
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
    
}
