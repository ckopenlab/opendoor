//
//  ViewController.m
//  OpenDoor
//
//  Created by Swing on 13-5-21.
//  Copyright (c) 2013年 Swing. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController

@synthesize myWebView, myDeviceID, myURL, myURLString;

- (void)viewDidLoad
{
    NSString *myIP = [[NSString alloc] initWithFormat:@"http://door.ckopenlab.com/open/"];
    myDeviceID = [[UIDevice currentDevice] uniqueIdentifier];
    myURLString = [myIP stringByAppendingString:myDeviceID];
    myURL = [[NSURL alloc] initWithString:myURLString];
    @try {
        [myWebView loadRequest:[NSURLRequest requestWithURL:myURL]];
    } @catch(NSException *e) {}
    [[NSNotificationCenter defaultCenter] addObserver:self
                                             selector:@selector(reFreshl:)
                                                 name:UIApplicationDidBecomeActiveNotification object:nil];
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}


- (IBAction)reFreshl:(id)sender {
    @try {
        [self.myWebView loadRequest:[NSURLRequest requestWithURL:self.myURL]];
    } @catch(NSException *e) {}

}

- (void)dealloc {
[[NSNotificationCenter defaultCenter] removeObserver:self];
}

@end
