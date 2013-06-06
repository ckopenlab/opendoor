//
//  ViewController.h
//  OpenDoor
//
//  Created by Swing on 13-5-21.
//  Copyright (c) 2013年 Swing. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ViewController : UIViewController
@property (weak, nonatomic) IBOutlet UIWebView *myWebView;
@property (weak, nonatomic) NSString *myDeviceID;
@property (weak, nonatomic) NSString *myURLString;
@property (strong, nonatomic) NSURL *myURL;

- (IBAction)reFreshl:(id)sender;

@end
