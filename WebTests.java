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
        
        
        webDriver.close();
        webDriver.quit();
    }

    private static boolean testSuccessfulLogin() {
        try {
            webDriver.navigate().to(SITE+"aciesla4.github.io/login.php");
            webDriver.findElement(By.name("username")).sendKeys("aeciesla@mtu.edu"); 
            webDriver.findElement(By.name("password")).sendKeys("wadsworth");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);
            
            if (webDriver.getCurrentUrl().equals(SITE+"aciesla4.github.io/profile.php")){
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
            webDriver.findElement(By.name("username")).sendKeys("aciesla4@gmail.com"); 
            webDriver.findElement(By.name("password")).sendKeys("wadsworth");
            webDriver.findElement(By.name("login")).click();
            Thread.sleep(500);

            if (webDriver.getCurrentUrl().equals(SITE+"aciesla4.github.io/login.php")){
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
            webDriver.findElement(By.name("name")).sendKeys("Ann"); 
            webDriver.findElement(By.name("username")).sendKeys("juliemarkann@aol.com");
            webDriver.findElement(By.name("password")).sendKeys("wadsworth");
            webDriver.findElement(By.name("teamName")).sendKeys("Mafia2");
            webDriver.findElement(By.name("createAccount")).click();
            Thread.sleep(500);

            if (webDriver.getCurrentUrl().equals(SITE+"aciesla4.github.io/profile.php")){
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
            webDriver.findElement(By.name("name")).sendKeys("Ann"); 
            webDriver.findElement(By.name("username")).sendKeys("aciesla4@gmail.com");
            webDriver.findElement(By.name("password")).sendKeys("wadsworth");
            webDriver.findElement(By.name("teamName")).sendKeys("Mafia");
            webDriver.findElement(By.name("createAccount")).click();
            Thread.sleep(500);

            if (webDriver.getCurrentUrl().equals(SITE+"aciesla4.github.io/profile.php")){
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
